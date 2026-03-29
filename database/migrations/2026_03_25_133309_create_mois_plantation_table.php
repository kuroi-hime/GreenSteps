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
        Schema::create('mois_plantation', function (Blueprint $table) {
            $table->id();
            $table->string('nom_mois');
            $table->enum('saison_mois', ['Printemps', 'Été', 'Automne', 'Hiver']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mois_plantation');
    }
};
