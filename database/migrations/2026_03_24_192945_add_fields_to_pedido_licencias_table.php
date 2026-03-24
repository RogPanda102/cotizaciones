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
        Schema::table('pedido_licencias', function (Blueprint $table) {
            $table->string('tipo_licencia')->nullable()->after('nombre_licencia');
            $table->string('clave_licencia')->nullable()->after('tipo_licencia');
            $table->integer('numero_usuarios')->nullable()->after('clave_licencia');
            $table->decimal('costo_renovacion', 10, 2)->nullable()->after('numero_usuarios');
            $table->string('estado')->nullable()->after('costo_renovacion'); // activa, vencida
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedido_licencias', function (Blueprint $table) {
            $table->dropColumn([
                'tipo_licencia',
                'clave_licencia',
                'numero_usuarios',
                'costo_renovacion',
                'estado',
            ]);
        });
    }
};
