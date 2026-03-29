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
        Schema::create('plantes', function (Blueprint $table) {
            $table->id();
            $table->string('nom_commun')->nullable();
            $table->string('nom_scientifique');
            $table->text('description_plante');
            // Nombre de jours entre deux arrosages
            $table->integer('frequence_arrosage');
            $table->integer('days_to_recolte');
            $table->string('difficulte_plante');
            $table->foreignId('categorie_id')->constrained('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantes');
    }
};
