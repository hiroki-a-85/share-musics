<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Support\Facades\Storage;

class WorksController extends Controller
{
    public function create()
    {
        $genres = Genre::all();
        
        $genre_counts = $genres->count();
        
        return view('works.work_submit', ['genres' => $genres, 'genre_counts' => $genre_counts]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            
            //max:10000 10MB以内である
            'artwork_path' => 'required|file|image|max:10000',
            'work_name' => 'required|string|unique:works,work_name|max:191',
            'artist_name' => 'required|string|max:191',
            'release_age_key' => 'required',
            'genre' => 'required',
        ]);
        
        //$_FILES['name属性の値'] にアップロードされたファイルに関する各種データが入る
        //$_FILES['artwork_path']['name']:元のファイル名を取得
        $saveFileName = $_FILES['artwork_path']['name'];

        //アップロードされたファイルはサーバ上の一時的な場所に存在
        //そのファイル名が一時ファイル名（tmp_name）
        //$_FILES['artwork_path']['tmp_name']:一時ファイル名を取得
        $img_path = $_FILES['artwork_path']['tmp_name'];

        //file_get_contents ('ファイルのパス'):ファイルデータを文字列に読み込む
        //今回は画像のパスを与え、画像データを読み込んでいる
        //それを$contentsに格納している
        $contents = file_get_contents($img_path);

        //Storageファサードのdiskメソッドを使用しs3へのアクセスを指定
        //putメソッドはファイル内容をディスクに保存する
        Storage::disk('s3')->put($saveFileName, $contents);
        
        // create()によりレコードを新規作成し、
        // そしてそのレコードのインスタンスを$new_workに代入
        // $new_workを使用して、新しいレコードに関連した操作が可能となる
        $new_work = $request->user()->works()->create([
            'work_name' => $request->work_name, 
            'artist_name' => $request->artist_name, 
            'release_age_key' => $request->release_age_key,
            'artwork_path' => $saveFileName,
        ]);
        
        //新しく作成した作品をお気に入りに追加
        $request->user()->favorite($new_work->id);
        
        //新しく作成した作品にジャンルを設定する
        for($i = 0;$i < count($request->genre);$i++){
            $genreId = Genre::where('genre_name', $request->genre[$i])->first()->id;
            $new_work->genres()->attach($genreId);
        }
        
        return redirect()->route('users.show', ['id' => \Auth::id()]);
    }
}
