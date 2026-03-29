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
        Schema::create('plante_mois', function (Blueprint $table) {
            $table->id();
            $table->string('type_action');
            $table->foreignId('plante_id')->constrained('plantes');
            $table->foreignId('mois_id')->constrained('mois_plantation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plante_mois');
    }
};
