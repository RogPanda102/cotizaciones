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
        Schema::table('dependencias', function (Blueprint $table) {
            $table->dropColumn('direccion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dependencias', function (Blueprint $table) {
            // 1. Volver a crear descripcion (no recupera datos, ojo)
            $table->text('descripcion')->nullable();

            // 2. Eliminar nombre corto
            $table->dropColumn('nombre_corto');
        });

        Schema::table('dependencias', function (Blueprint $table) {
            // 3. Regresar nombre_oficial → nombre
            $table->renameColumn('nombre_oficial', 'nombre');
        });
    }
};
