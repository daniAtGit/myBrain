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
        Schema::create('manutenzioni', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('oggetto_id')->nullable();
            $table->uuid('fornitore_id')->nullable();
            $table->date('data');
            $table->decimal('prezzo', $precision = 8, $scale = 2);
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('oggetto_id')->references('id')->on('manut_oggetti')->onDelete('set null');
            $table->foreign('fornitore_id')->references('id')->on('manut_fornitori')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manutenzioni');
    }
};
