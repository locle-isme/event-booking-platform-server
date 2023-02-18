<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeakersTable extends Migration
{
    public function up()
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 50);
            $table->date('birthday');
            $table->string('avatar')->nullable();
            $table->string('social_linking', 200)->nullable();
            $table->text('description')->nullable();
            $table->integer('organizer_id');
            $table->foreign('organizer_id')->references('id')->on('organizers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('speakers');
    }
}
