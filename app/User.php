<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //お気に入り機能のための、多対多の関係の記述
    //第1引数に得る対象であるWorkクラス、第2引数には中間テーブルであるfavorites
    //第3引数に自分のidを示す中間テーブルカラム名、第4引数に相手先のidを示す中間テーブルカラム名
    public function favorites()
    {
        return $this->belongsToMany(Work::class, 'favorites', 'user_id', 'work_id')->withTimestamps();
    }
    
    //現在のお気に入りの中に、$workIdがあるかどうか調べるメソッド
    public function is_in_favorites($workId)
    {
        return $this->favorites()->where('work_id', $workId)->exists();
    }
    
    //お気に入りに追加するメソッドfavorite($workId)を定義
    public function favorite($workId)
    {
        $exist = $this->is_in_favorites($workId);
        
        if ($exist) {
            //お気に入りに追加していれば、何もしない
            return false;
        } else {
            //お気に入りになければ、お気に入りに追加する
            $this->favorites()->attach($workId);
            return true;
        }
    }
    
    //お気に入りから外すメソッドunfavorite($workId)を定義
    public function unfavorite($workId)
    {
        //既にお気に入りに追加しているかの確認
        $exist = $this->is_in_favorites($workId);
        
        if (!$exist) {
            //既にお気に入りに追加していなければ、何もしない
            return false;
        } else {
            //そうでなければ、お気に入りから外す
            $this->favorites()->detach($workId);
            return true;
        }
    }
}
