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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['dog', 'cat', 'other']);
            $table->string('breed')->nullable();
            $table->integer('age')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('size', ['small', 'medium', 'large'])->nullable();
            $table->json('characteristics')->nullable(); // For storing traits like friendly, playful, etc.
            $table->boolean('is_available')->default(true);
            $table->decimal('adoption_fee', 8, 2)->nullable();
            $table->text('medical_history')->nullable();
            $table->boolean('is_vaccinated')->default(false);
            $table->boolean('is_neutered')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};