<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionSpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_speakers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();;
            $table->integer('session_id');
            $table->integer('speaker_id');
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->foreign('speaker_id')->references('id')->on('speakers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_speakers');
    }
}
