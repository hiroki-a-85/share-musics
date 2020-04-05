<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //複数ジャンル設定のための、多対多の関係の記述
    //第1引数に得る対象であるWorkクラス、第2引数には中間テーブルであるmultiple_genres
    //第3引数に自分のidを示す中間テーブルカラム名、第4引数に相手先のidを示す中間テーブルカラム名
    public function works()
    {
        return $this->belongsToMany(Work::class, 'multiple_genres', 'genre_id', 'work_id')->withTimestamps();
    }
}
