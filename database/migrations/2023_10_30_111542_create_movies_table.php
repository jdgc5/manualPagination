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
        //movie : id ( pk ) , title(unique), director , year , genre(null)
        Schema::create('movie', function (Blueprint $table) {
            $table->id();
            $table->string('title', 60)->unique();
            $table->string('director', 100);
            $table->year('year');
            $table->string('genre', 50)->nullable();
            $table->timestamps(); //marcasDeTiempo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie');
    }
};
