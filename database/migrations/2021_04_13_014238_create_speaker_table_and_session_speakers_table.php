<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeakerTableAndSessionSpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 50);
            $table->date('birthday');
            $table->string('avatar');
            $table->string('social_linking', 200);
            $table->string('description');
        });

        Schema::create('session_speakers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();;
            $table->integer('session_id');
            $table->integer('speaker_id');
        });

        Schema::table('session_speakers', function (Blueprint $table) {
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
        Schema::dropIfExists('speakers');
    }
}
