<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /** ToDo: Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different showrooms

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {
        Schema::create('showrooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('status');
            $table->decimal('expected_payment', 12, 4);
            $table->decimal('total_earned', 12, 4);
        });


        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('showroom_id')->references('id')->on('showrooms');
            $table->string('name');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
        });


        Schema::create('showroom_seats', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('showroom_id')->references('id')->on('showrooms');
            $table->integer('seat_no');
            $table->integer('seat_type');
            $table->decimal('premium_adjustment', 12, 4);
            $table->decimal('price', 12, 4);
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
