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
            // Add new social characteristic fields
            if (!Schema::hasColumn('pets', 'good_with_kids')) {
                $table->boolean('good_with_kids')->default(false)->after('is_neutered');
            }
            if (!Schema::hasColumn('pets', 'good_with_pets')) {
                $table->boolean('good_with_pets')->default(false)->after('good_with_kids');
            }
            if (!Schema::hasColumn('pets', 'social_behavior')) {
                $table->string('social_behavior')->nullable()->after('good_with_pets');
            }
            if (!Schema::hasColumn('pets', 'characteristics')) {
                $table->json('characteristics')->nullable()->after('social_behavior');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            if (Schema::hasColumn('pets', 'good_with_kids')) {
                $table->dropColumn('good_with_kids');
            }
            if (Schema::hasColumn('pets', 'good_with_pets')) {
                $table->dropColumn('good_with_pets');
            }
            if (Schema::hasColumn('pets', 'social_behavior')) {
                $table->dropColumn('social_behavior');
            }
            if (Schema::hasColumn('pets', 'characteristics')) {
                $table->dropColumn('characteristics');
            }
        });
    }
};
