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
            
            $table->dropForeign(['cliente_id']);
            $table->renameColumn('cliente_id', 'departamento_id');
        });
        Schema::table('pedidos', function (Blueprint $table) {

            $table->foreign('departamento_id')
                ->references('id')
                ->on('departamentos')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {

            $table->dropForeign(['departamento_id']);

            $table->renameColumn('departamento_id', 'cliente_id');
        });

        Schema::table('pedidos', function (Blueprint $table) {

            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->nullOnDelete();
        });
    }
};
