<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(4);
        
        return view('welcome', ['users' => $users]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        
        //お気に入り作品を、中間テーブルfavoritesのupdated_atカラムが最新のものから取得
        $favorite_works = $user->favorites()->orderBy('favorites.updated_at', 'desc')->paginate(4);
        
        $data = [
            'user' => $user,
            'favorite_works' => $favorite_works,
        ];
        
        return view('users.user_show', $data);
    }
    
}
