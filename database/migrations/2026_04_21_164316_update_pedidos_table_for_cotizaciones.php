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
        Schema::table('pedidos', function (Blueprint $table) {
            $table->renameColumn('requisicion_id', 'cotizacion_id');
        });
        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreignId('analista_id')
                ->nullable()
                ->after('empresa_id')
                ->constrained('analistas')
                ->nullOnDelete();

            $table->string('lugar_entrega');
            $table->text('condiciones_entrega');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['analista_id']);
            $table->dropColumn('analista_id');
            $table->dropColumn('lugar_entrega');
            $table->dropColumn('condiciones_entrega');
        });

        Schema::table('pedidos', function (Blueprint $table) {
            $table->renameColumn('cotizacion_id', 'requisicion_id');
        });
    }
};
