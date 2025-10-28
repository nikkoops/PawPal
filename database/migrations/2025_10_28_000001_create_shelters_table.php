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
        Schema::create('shelters', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            // Max capacity must be between 50 and 300
            $table->unsignedSmallInteger('max_capacity')->default(100);
            $table->timestamps();
        });

        // Optional: populate with some known shelter locations (use lowercase-insensitive names used in users/pets)
        $shelters = [
            'Caloocan Shelter', 'Makati Shelter', 'Mandaluyong Shelter', 'Quezon City Shelter',
            'Manila Shelter', 'Taguig Shelter', 'Pasig Shelter', 'Marikina Shelter'
        ];

        foreach ($shelters as $name) {
            DB::table('shelters')->insert([
                'name' => $name,
                'max_capacity' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shelters');
    }
};
