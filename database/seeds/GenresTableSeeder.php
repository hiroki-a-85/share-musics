<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            'genre_name' => 'Rock',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Pop',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Indie',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Alternative',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Punk',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Emo',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Hardcore/Punk',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Melodic Punk',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Post-Rock',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Hard Rock',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Metal',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Power Pop',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'J-Pop',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Funk',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Folk',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Acoustic',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'R&B',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Soul',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Hip Hop',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Reggae',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Ska',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Classic',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Electronic',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Experimental',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Instrumental',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Ambient',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Soundtrack',
        ]);
        DB::table('genres')->insert([
            'genre_name' => 'Other',
        ]);
    }
}
