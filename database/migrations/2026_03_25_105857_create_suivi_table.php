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
        Schema::create('suivi', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date_ajout');
            $table->foreignId('jardin_id')->constrained('jardins');
            $table->foreignId('plante_id')->constrained('plantes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suivi');
    }
};
