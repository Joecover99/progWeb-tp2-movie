<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ActorSeeder::class,
            LanguageSeeder::class,
            MovieSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
