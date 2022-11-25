<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sport_id');
            $table->unsignedBigInteger('league_id');
            $table->unsignedBigInteger('club_id_one');
            $table->unsignedBigInteger('club_id_two');
            $table->string('slug')->unique();
            $table->date('date');
            $table->time('time');
            $table->string('sport_type');
            $table->string('channel')->nullable();
            $table->string('channel_url')->nullable();
            $table->string('location')->nullable();
            $table->string('location_url')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('highlight')->default(0);
            $table->timestamps();
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade')->onUpdate('no action');
            $table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
