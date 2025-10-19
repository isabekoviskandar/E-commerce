<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['description_uz', 'description_ru', 'description_en']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->text('description_uz')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_en')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['description_uz', 'description_ru', 'description_en']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('description_uz', 255)->nullable();
            $table->string('description_ru', 255)->nullable();
            $table->string('description_en', 255)->nullable();
        });
    }
};
