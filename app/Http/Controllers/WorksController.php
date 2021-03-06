<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Work;
use App\Genre;

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
            
            //max:2000 2MB以内である
            'artwork_path' => 'required|file|image|max:2000',
            'work_name' => 'required|string|unique:works,work_name|max:191',
            'artist_name' => 'required|string|max:191',
            'release_age_key' => 'required',
            'genre' => 'required',
        ]);

        //$_FILES['name属性の値'] にアップロードされたファイルに関する各種データが入る
        //アップロードされたファイルはサーバ上の一時的な場所に存在
        //そのファイル名が一時ファイル名（tmp_name）
        //$_FILES['artwork_path']['tmp_name']:一時ファイル名を取得
        $img_path = $_FILES['artwork_path']['tmp_name'];

        //file_get_contents ('ファイルのパス'):ファイルデータを文字列に読み込む
        //今回は画像のパスを与え、画像データを読み込んでいる
        //それを$contentsに格納している
        $contents = file_get_contents($img_path);
        
        //$_FILES['artwork_path']['name']:元のファイル名を取得
        //一意なファイル名にしておくため、先頭に文字列を連結
        $save_file_name = date('Ymd_His') . 'userid_' . $request->user()->id . $_FILES['artwork_path']['name'];

        //Storageファサードのdiskメソッドを使用しs3へのアクセスを指定
        //putメソッドはファイル内容をディスクに保存する
        Storage::disk('s3')->put($save_file_name, $contents);

        // create()によりレコードを新規作成し、
        // そしてそのレコードのインスタンスを$new_workに代入
        // $new_workを使用して、新しいレコードに関連した操作が可能となる
        $new_work = $request->user()->works()->create([
            'work_name' => $request->work_name, 
            'artist_name' => $request->artist_name, 
            'release_age_key' => $request->release_age_key,
            'artwork_path' => $save_file_name,
        ]);
        
        //新しく作成した作品をお気に入りに追加
        $request->user()->favorite($new_work->id);
        
        //新しく作成した作品にジャンルを設定する
        for($i = 0;$i < count($request->genre);$i++){
            $genreId = $request->genre[$i];
            $new_work->genres()->attach($genreId);
        }
        
        return redirect()->route('users.show', ['id' => \Auth::id()]);
    }
    
    public function show($id)
    {
        $work = Work::find($id);
        
        $genres = $work->genres()->get();
        
        $users = $work->favorite_users()->orderBy('favorites.updated_at', 'desc')->paginate(4);
        
        $three_fav_works = [];
        foreach($users as $user){
            //各ユーザのお気に入りを３つ取得
            $works = $user->favorites()->where('works.id', '!=', $work->id)->limit(3)->get();
            
            //連想配列$three_fav_works:['あるユーザのid' => [上記で定義したコレクション]]を作成
            $three_fav_works[$user->id] = $works;
        }
        
        return view('works.work_show', ['work' => $work, 'genres' => $genres, 'users' => $users, 'three_fav_works' => $three_fav_works]);
    }
    
    public function edit($id)
    {
        $work = Work::find($id);
        
        if (\Auth::id() !== $work->user_id) {
            return back();
        }
        
        $genres = Genre::all();
        
        $genre_counts = $genres->count();
        
        $work_genres = $work->genres()->get();
        
        $work_genres_ids = [];
        foreach($work_genres as $work_genre){
            $work_genres_ids[] = $work_genre->id;
        }
        
        $data = [
            'work' => $work, 
            'genres' => $genres, 
            'genre_counts' => $genre_counts,
            'work_genres_ids' => $work_genres_ids,
            ];
        
        return view('works.work_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $work = Work::find($id);
        
        if (\Auth::id() !== $work->user_id) {
            return back();
        }
        
        $this->validate($request, [
            'artwork_path' => 'file|image|max:2000',
            'work_name' => 'required|string|max:191',
            'artist_name' => 'required|string|max:191',
            'release_age_key' => 'required',
            'genre' => 'required',
        ]);
        
        /**
         * 画像の処理
         *
         * 
         */
        
        $img_path = $_FILES['artwork_path']['tmp_name'];
        
        //ファイル何も選択していない時、つまり現在の画像で良い時、$img_pathは""空文字
        //「!$img_path == ""」→ファイルをアップロードしている時の処理を以下に記述
        
        if (!$img_path == ""){
            
            $contents = file_get_contents($img_path);
            
            $save_file_name = date('Ymd_His') . 'userid_' . $request->user()->id . $_FILES['artwork_path']['name'];
    
            //s3へファイル内容を保存する
            Storage::disk('s3')->put($save_file_name, $contents);
            
            //以前のファイルの削除
            Storage::disk('s3')->delete($work->artwork_path);
            
            $work->artwork_path = $save_file_name;
        }
        
        $work->work_name = $request->work_name;
        $work->artist_name = $request->artist_name;
        $work->release_age_key = $request->release_age_key;
        $work->save();
        
        /**
         * ジャンル設定の処理
         *
         * 
         */
        
        $request_genre_ids = $request->genre;
        
        $work_genres = $work->genres()->get();
        $work_genres_ids = [];
        foreach($work_genres as $work_genre){
            $work_genres_ids[] = $work_genre->id;
        }
        
        foreach($request_genre_ids as $request_genre_id){
            //既に設定されているジャンルの中からリクエストのジャンルを探し、falseでない（存在した）
            if(!is_bool(array_search($request_genre_id, $work_genres_ids))){
                continue;
            }else{
                //既に設定されている中に無かった→設定する
                $work->genres()->attach($request_genre_id);
            }
        }
        
        foreach($work_genres_ids as $work_genres_id){
            //リクエストのジャンルの中から、既に設定されているジャンルを一つずつ探し、falseでない（存在した）
            if(!is_bool(array_search($work_genres_id, $request_genre_ids))){
                continue;
            }else{
                //リクエストのジャンルの中に無い→ジャンルを外す
                $work->genres()->detach($work_genres_id);
            }
        }
        
        return redirect()->route('works.show', ['id' => $work->id]);
    }

    public function destroy($id)
    {
        $work = Work::find($id);
        
        if (\Auth::id() !== $work->user_id) {
            return back();
        }
        
        Storage::disk('s3')->delete($work->artwork_path);
        
        $work->delete();
        
        return redirect()->route('users.submit_index', ['id' => \Auth::id()]);
    }
    
    public function by_release_age_index($year)
    {
        $works = Work::where('release_age_key', $year)->paginate(4);
        
        return view('works.result_works_index', ['works' => $works, 'year' => $year]);
    }
    
    public function by_genre_index($genreId)
    {
        $genre = Genre::find($genreId);
        
        $works = $genre->works()->paginate(4);
        
        return view('works.result_works_index', ['works' => $works, 'genre' => $genre]);
    }
    
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
 
        $query = Work::query();
 
        if (!empty($keyword)) {
            $query->where('work_name', 'LIKE', "%{$keyword}%")
                ->orWhere('artist_name', 'LIKE', "%{$keyword}%");
        }
 
        $works = $query->paginate(4);
        
        return view('works.result_works_index', ['works' => $works, 'keyword' => $keyword]);
    }
}
