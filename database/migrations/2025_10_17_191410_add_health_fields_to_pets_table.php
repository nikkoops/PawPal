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
            $table->boolean('is_dewormed')->default(false)->after('is_neutered');
            $table->boolean('is_tick_flea_treated')->default(false)->after('is_dewormed');
            $table->boolean('on_preventive_medication')->default(false)->after('is_tick_flea_treated');
            $table->boolean('has_special_medical_needs')->default(false)->after('on_preventive_medication');
            $table->boolean('is_mobility_impaired')->default(false)->after('has_special_medical_needs');
            $table->boolean('is_undergoing_treatment')->default(false)->after('is_mobility_impaired');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn([
                'is_dewormed',
                'is_tick_flea_treated',
                'on_preventive_medication',
                'has_special_medical_needs',
                'is_mobility_impaired',
                'is_undergoing_treatment'
            ]);
        });
    }
};
