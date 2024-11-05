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
        Schema::create('links', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('favorite_id');
            $table->integer('index');
            $table->string('title')->nullable();
            $table->text('url')->nullable();
            $table->integer('selfId');
            $table->integer('parentId');
            $table->timestamps();

            $table->foreign('favorite_id')->references('id')->on('favorites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
