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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name_uz')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('name_eng')->nullable();
            $table->string('description_uz')->nullable();
            $table->string('description_ru')->nullable();
            $table->string('description_eng')->nullable();
            $table->string('country_uz')->nullable();
            $table->string('country_ru')->nullable();
            $table->string('country_eng')->nullable();
            $table->string('composition_uz')->nullable();
            $table->string('composition_ru')->nullable();
            $table->string('composition_eng')->nullable();
            $table->integer('count')->nullable();
            $table->integer('price')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
