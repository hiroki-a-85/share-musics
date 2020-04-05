<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultipleGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple_genres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('work_id')->unsigned()->index();
            $table->integer('genre_id')->unsigned()->index();
            $table->timestamps();
            
            // 外部キー設定
            $table->foreign('work_id')->references('id')->on('works')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            
            // work_idとgenre_idの組み合わせの重複を許さない
            $table->unique(['work_id', 'genre_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multiple_genres');
    }
}
