<?php

use App\Language;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class LanguageSeeder extends Seeder
{
    public function run() {
        Language::create(['name' => 'English']);
        Language::create(['name' => 'Italian']);
        Language::create(['name' => 'Japanese']);
        Language::create(['name' => 'Mandarin']);
        Language::create(['name' => 'French']);
        Language::create(['name' => 'German']);
    }
}
