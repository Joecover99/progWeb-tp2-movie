<?php

use App\Language;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class LanguageSeeder extends Seeder
{
    public function run() {
        (new Language(['name' => 'English']))->save();
        (new Language(['name' => 'Italian']))->save();
        (new Language(['name' => 'Japanese']))->save();
        (new Language(['name' => 'Mandarin']))->save();
        (new Language(['name' => 'French']))->save();
        (new Language(['name' => 'German']))->save();
    }
}
