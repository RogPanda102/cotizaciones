<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE pedidos 
            MODIFY estado ENUM(
                'en_proceso',
                'facturado',
                'entregado',
                'pagado'
            ) NOT NULL DEFAULT 'en_proceso'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE pedidos 
            MODIFY estado ENUM(
                'en_proceso',
                'facturado',
                'pagado',
                'vencido'
            ) NOT NULL DEFAULT 'en_proceso'
        ");
    }
};
