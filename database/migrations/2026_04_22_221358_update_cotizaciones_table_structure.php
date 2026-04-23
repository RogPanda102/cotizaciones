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
         // 1. Eliminar columnas que ya no usas
        Schema::table('cotizaciones', function (Blueprint $table) {
            if (Schema::hasColumn('cotizaciones', 'descripcion')) {
                $table->dropColumn('descripcion');
            }

            if (Schema::hasColumn('cotizaciones', 'estado')) {
                $table->dropColumn('estado');
            }
        });

        // 2. Agregar nuevos campos
        Schema::table('cotizaciones', function (Blueprint $table) {

            // Relaciones
            $table->foreignId('departamento_id')
                ->nullable()
                ->after('folio_externo')
                ->constrained('departamentos')
                ->nullOnDelete();

            $table->foreignId('dependencia_id')
                ->nullable()
                ->after('departamento_id')
                ->constrained('dependencias')
                ->nullOnDelete();

            $table->foreignId('empresa_id')
                ->nullable()
                ->after('dependencia_id')
                ->constrained('empresas')
                ->nullOnDelete();

            $table->foreignId('analista_id')
                ->nullable()
                ->after('empresa_id')
                ->constrained('analistas')
                ->nullOnDelete();

            // Fechas
            $table->date('fecha_recepcion')->nullable();
            $table->date('fecha_envio')->nullable();

            // Financieros
            $table->decimal('monto_total', 15, 2)->nullable();
            $table->integer('dias_credito')->nullable();

            // Otros
            $table->integer('garantia')->nullable();

            $table->enum('tipo_dias', ['naturales', 'habiles'])->nullable();

            $table->enum('tipo_cotizacion', [
                'omg',
                'dependencia_directa',
                'cliente_externo'
            ])->default('omg');

            $table->string('numero_cotizacion', 6)->nullable();

            $table->enum('estado', [
                'enviado',
                'respaldo',
                'no_cotiza'
            ])->default('enviado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {

            // Eliminar nuevas columnas
            $table->dropForeign(['departamento_id']);
            $table->dropForeign(['dependencia_id']);
            $table->dropForeign(['empresa_id']);
            $table->dropForeign(['analista_id']);

            $table->dropColumn([
                'departamento_id',
                'dependencia_id',
                'empresa_id',
                'analista_id',
                'fecha_recepcion',
                'fecha_envio',
                'monto_total',
                'dias_credito',
                'garantia',
                'tipo_dias',
                'tipo_cotizacion',
                'numero_cotizacion',
                'estado'
            ]);
        });

        // Restaurar columnas viejas (sin datos)
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->text('descripcion')->nullable();

            $table->enum('estado', [
                'pendiente',
                'adjudicada',
                'no_adjudicada'
            ])->default('pendiente');
        });
    }
};
