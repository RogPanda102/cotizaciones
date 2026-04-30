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
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->time('horario_de_entrega')->nullable()->after('fecha_recepcion');
            $table->string('lugar_de_entrega')->nullable()->after('horario_de_entrega');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->dropColumn('horario_de_entrega');
            $table->dropColumn('lugar_de_entrega');
        });
    }
};
