<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    const ratingEnum = [
        'G',
        'PG',
        'PG-13',
        'R',
        'NC-17'
    ];

    const specialFeatures = [
        'Trailers',
        'Commentaries',
        'Deleted Scenes',
        'Behind the Scenes'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->year('release_year');
            $table->tinyInteger('language_id');
            $table->tinyInteger('original_language_id')->nullable();
            $table->tinyInteger('rental_duration')->default(3);
            $table->decimal('rental_rate',4,2)->default(4.99);
            $table->smallInteger('length')->nullable();
            $table->decimal('replacement_cost',5,2)->default(19.99);
            $table->enum('rating', self::ratingEnum)->nullable()->default('G');
            $table->set('special_features', self::specialFeatures)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
