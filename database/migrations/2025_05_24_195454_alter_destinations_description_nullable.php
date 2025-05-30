<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDestinationsDescriptionNullable extends Migration
{
    public function up()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->text('description')->change();
        });
    }
}
