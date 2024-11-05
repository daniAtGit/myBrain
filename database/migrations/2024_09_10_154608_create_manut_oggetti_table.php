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
        Schema::create('manut_oggetti', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('categoria_id')->nullable();
            $table->uuid('brand_id')->nullable();
            $table->text('descrizione')->nullable();
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('manut_categorie')->onDelete('set null');
            $table->foreign('brand_id')->references('id')->on('manut_brands')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manut_oggetti');
    }
};
