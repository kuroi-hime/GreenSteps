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
        Schema::table('plantes', function (Blueprint $table) {
            $table->decimal('height_plante', 10, 2);
            $table->decimal('min_temp_plante', 10, 2);
            $table->decimal('max_temp_plante', 10, 2);
            $table->string('sunlight_plante');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plantes', function (Blueprint $table) {
            $table->dropColumn(['height_plante', 'min_temp_plante', 'max_temp_plante', 'sunlight_plante']);
        });
    }
};
