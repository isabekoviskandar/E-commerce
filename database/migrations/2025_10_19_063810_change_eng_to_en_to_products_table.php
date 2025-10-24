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
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'name_eng')) {
                $table->renameColumn('name_eng', 'name_en');
            }

            if (Schema::hasColumn('products', 'description_eng')) {
                $table->renameColumn('description_eng', 'description_en');
            }

            if (Schema::hasColumn('products', 'composition_eng')) {
                $table->renameColumn('composition_eng', 'composition_en');
            }

            if (Schema::hasColumn('products', 'country_eng')) {
                $table->renameColumn('country_eng', 'country_en');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'name_en')) {
                $table->renameColumn('name_en', 'name_eng');
            }

            if (Schema::hasColumn('products', 'description_en')) {
                $table->renameColumn('description_en', 'description_eng');
            }

            if (Schema::hasColumn('products', 'composition_en')) {
                $table->renameColumn('composition_en', 'composition_eng');
            }

            if (Schema::hasColumn('products', 'country_en')) {
                $table->renameColumn('country_en', 'country_eng');
            }
        });
    }
};
