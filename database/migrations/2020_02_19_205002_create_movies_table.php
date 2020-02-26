<?php

use App\Movie;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    
    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->year('release_year');
            $table->smallInteger('length')->nullable();
            $table->text('description')->nullable();
            $table->enum('rating', Movie::ratingEnum)->nullable()->default('G');
            $table->tinyInteger('language_id');
            $table->tinyInteger('original_language_id')->nullable();
            $table->tinyInteger('rental_duration')->default(3);
            $table->decimal('rental_rate',4,2)->default(4.99);
            $table->decimal('replacement_cost',5,2)->default(19.99);
            $table->set('special_features', Movie::specialFeatures)->nullable();
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
