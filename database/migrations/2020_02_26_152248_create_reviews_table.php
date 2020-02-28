<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            // user id
            $table->bigInteger('user_id', false, true)->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // movie id
            $table->bigInteger('movie_id', false, true)->index();
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');

            $table->double('score', 3, 1);
            $table->text('comment');
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
        Schema::dropIfExists('reviews');
    }
}
