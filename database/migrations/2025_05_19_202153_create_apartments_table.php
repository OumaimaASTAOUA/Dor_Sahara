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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->text('description')->nullable(false);
            $table->string('location', 255)->nullable(false);
            $table->decimal('price', 10, 2)->nullable(false);
            $table->decimal('rating', 3, 1)->nullable();
            $table->boolean('availability')->default(true);
            $table->enum('status', ['Actif', 'Inactif'])->default('Actif');
            $table->string('link', 255)->nullable(false);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
