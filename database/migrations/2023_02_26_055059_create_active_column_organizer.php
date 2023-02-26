<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveColumnOrganizer extends Migration
{
    public function up()
    {
        Schema::table('organizers', function (Blueprint $table) {
            $table->boolean('active')->after('password_hash');
        });
    }

    public function down()
    {
        Schema::table('organizers', function (Blueprint $table) {
            //
            $table->dropColumn('active');
        });
    }
}
