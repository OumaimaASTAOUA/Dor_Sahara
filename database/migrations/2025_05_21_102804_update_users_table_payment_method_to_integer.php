<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            \App\Models\User::whereNull('payment_method')->update(['payment_method' => 0]);
            \App\Models\User::whereNotNull('payment_method')->update(['payment_method' => 1]);
            $table->tinyInteger('payment_method')->unsigned()->default(0)->change();
            \App\Models\User::where('phone', 'default_phone')->update(['phone' => '0000000000']);
            $table->string('phone')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->change();
            $table->string('phone')->nullable()->change();
        });
    }
};
