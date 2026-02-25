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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('requisicion_id')
                ->constrained('requisiciones')
                ->onDelete('cascade');

            $table->foreignId('dependencia_id')
                ->constrained('dependencias')
                ->onDelete('restrict');

            $table->decimal('monto_total_aprobado', 12, 2);

            $table->date('fecha_adjudicacion');
            $table->date('fecha_entrega');

            $table->date('fecha_facturacion')->nullable();
            $table->enum('tipo_dias', ['habiles', 'naturales'])->default('habiles');
            $table->integer('dias_credito');

            $table->enum('estado', [
                'en_proceso',
                'facturado',
                'pagado',
                'vencido'
            ])->default('en_proceso');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
