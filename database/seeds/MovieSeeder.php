<?php

use Illuminate\Database\Seeder;
use App\Movie;
use App\Actor;
USE Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Movie::class, 100)->create();

        for ($i=0; $i < 150; $i++) { 
            DB::table('actor_movie')->insert([
                'movie_id' => Movie::all()->random()->first()->id,
                'actor_id' => Movie::all()->random()->first()->id,
            ]);
        }
    }
}
