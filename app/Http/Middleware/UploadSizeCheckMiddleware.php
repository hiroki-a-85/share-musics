<?php

namespace App\Http\Middleware;

use Closure;

class UploadSizeCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //phpinfo()よりphp.ini設定情報を確認
        //post_max_size	20M
        //upload_max_filesize 20M　と変更
        
        //ini_get('post_max_size'):"20M"と取得
        //mb_substr(ini_get('post_max_size'),0,2):"20"と取得
        //20Mは20Mバイト
        
        //PHP:リクエストデータ量をバイトで取得する - $_SERVER['CONTENT_LENGTH']
        
        if(isset($_SERVER['CONTENT_LENGTH'])){
            
            $post_max_size = (int)mb_substr(ini_get('post_max_size'),0,2) * 1024 * 1024;
            $uploaded_size = intval($_SERVER['CONTENT_LENGTH']);                          
            
            if($post_max_size < $uploaded_size ){
                //with()
                //新しいページヘリダイレクトした後、
                //セッションへ保存したフラッシュデータのメッセージを取り出して、表示できる
                //ビューではsession('message_post_max_size')で表示させる
                return back()->with('message_post_max_size', 'This file is too large.');
            }  
        } 
        
        return $next($request);
    }
}
