<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Genre;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(4);
        
        $genres = Genre::all();
        
        $three_fav_works = [];
        foreach($users as $user){
            //各ユーザのお気に入りを３つ取得
            $works = $user->favorites()->limit(3)->get();
            
            //連想配列$three_fav_works:['あるユーザのid' => [上記で定義したコレクション]]を作成
            $three_fav_works[$user->id] = $works;
        }
        
        return view('welcome', ['users' => $users, 'works' => $three_fav_works, 'genres' => $genres]);
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
