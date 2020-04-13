<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(4);
        
        $s3_artwork_urls = [];
        foreach($users as $user){
            //各ユーザのお気に入りを３つ取得、それぞれのアクセサ:s3_artwork_urlの値をpluckメソッドで配列で取得
            $urls = $user->favorites()->limit(3)->get()->pluck('s3_artwork_url');
            
            //連想配列$s3_artwork_urls:['あるユーザのid' => [上記で定義した配列]]を作成
            $s3_artwork_urls[$user->id] = $urls;
        }
        
        return view('welcome', ['users' => $users, 's3_artwork_urls' => $s3_artwork_urls]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        
        //お気に入り作品を、中間テーブルfavoritesのupdated_atカラムが最新のものから取得
        $favorite_works = $user->favorites()->orderBy('favorites.updated_at', 'desc')->paginate(4);
        
        return view('users.user_show', ['user' => $user, 'works' => $favorite_works]);
    }
    
    public function submit_index($userId)
    {
        $user = User::find($userId);
        
        //投稿した作品一覧を取得
        $submit_works = $user->works()->paginate(4);
        
        return view('users.user_show', ['user' => $user, 'works' => $submit_works]);
    }
}
