<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Genre;
use App\Work;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(4);
        
        $three_fav_works = [];
        foreach($users as $user){
            //各ユーザのお気に入りを３つ取得
            $works = $user->favorites()->limit(3)->get();
            
            //連想配列$three_fav_works:['あるユーザのid' => [上記で定義したコレクション]]を作成
            $three_fav_works[$user->id] = $works;
        }
        
        $counts_of_works_by_age = [];
        for ($i = 0;(1950 + (10 * $i)) <= 2020;$i++){
            $age = (1950 + (10 * $i));
            $counts_of_works_by_age[$age] = Work::where('release_age_key', $age)->get()->count();
        }
        
        $genres = Genre::all();
        
        $counts_of_works_by_genre = [];
        foreach ($genres as $genre){
           $counts_of_works_by_genre[$genre->id] = $genre->works()->get()->count();
        }
        
        $data = [
            'users' => $users, 
            'works' => $three_fav_works, 
            'genres' => $genres,
            'counts_of_works_by_age' => $counts_of_works_by_age,
            'counts_of_works_by_genre' => $counts_of_works_by_genre,
            ];
        
        return view('welcome', $data);
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
