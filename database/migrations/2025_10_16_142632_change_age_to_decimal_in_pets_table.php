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
        Schema::table('pets', function (Blueprint $table) {
            // Change age from integer to decimal to support months
            // decimal(4,2) allows values like 0.08 (1 month) to 99.99
            $table->decimal('age', 4, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            // Revert back to integer
            $table->integer('age')->nullable()->change();
        });
    }
};
