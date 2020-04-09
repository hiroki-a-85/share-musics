<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(4);
        
        $artwork_paths = [];
        foreach($users as $user){
            //各ユーザのお気に入りを３つ取得、それぞれのartwork_pathカラムの値をpluckメソッドで配列で取得
            $paths = $user->favorites()->limit(3)->get()->pluck('artwork_path');
            
            //連想配列['あるユーザのid' => '上記で定義した配列']を作成
            $artwork_paths[$user->id] = $paths;
        }
        
        return view('welcome', ['users' => $users, 'artwork_paths' => $artwork_paths]);
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
