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
        Schema::table('adoption_applications', function (Blueprint $table) {
            // Make foreign keys nullable
            $table->foreignId('user_id')->nullable()->change();
            $table->foreignId('pet_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adoption_applications', function (Blueprint $table) {
            // Restore non-null constraint
            $table->foreignId('user_id')->nullable(false)->change();
            $table->foreignId('pet_id')->nullable(false)->change();
        });
    }
};