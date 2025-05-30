<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('group_touristiques', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('duration');
            $table->integer('max_people');
            $table->string('starting_point');
            $table->json('caravan_name');
            $table->json('images')->nullable();
            $table->string('registration_link');
            $table->json('social_media_links');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_touristiques');
    }
};
