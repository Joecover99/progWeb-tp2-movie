<?php

use App\Critic;
use Illuminate\Database\Seeder;

class CriticSeeder extends Seeder
{
    public function run()
    {
        factory(Critic::class, 20)->create();
    }
}
