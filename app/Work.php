<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ['user_id', 'work_name', 'artist_name', 'release_age_key', 'artwork_path'];
    
    //作品投稿機能のための、１(User)対多(Works)の関係の記述
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    //お気に入り機能のための、多対多の関係の記述
    //第1引数に得る対象であるWorkクラス、第2引数には中間テーブルであるfavorites
    //第3引数に自分のidを示す中間テーブルカラム名、第4引数に相手先のidを示す中間テーブルカラム名
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'work_id', 'user_id')->withTimestamps();
    }
    
    //複数ジャンル設定のための、多対多の関係の記述
    //第1引数に得る対象であるGenreクラス、第2引数には中間テーブルであるmultiple_genres
    //第3引数に自分のidを示す中間テーブルカラム名、第4引数に相手先のidを示す中間テーブルカラム名
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'multiple_genres', 'work_id', 'genre_id')->withTimestamps();
    }
}
