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
        Schema::table('inventarios', function (Blueprint $table) {
            // COLOCAMOS ESTA LÍNEA AQUÍ PARA CREAR EL ÍNDICE 👇
            $table->index('id_crea_producto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventarios', function (Blueprint $table) {
            // COLOCAMOS ESTA LÍNEA AQUÍ PARA QUE LARAVEL SEPA CÓMO BORRARLO SI ES NECESARIO 👇
            $table->dropIndex(['id_crea_producto']);
        });
    }
};
