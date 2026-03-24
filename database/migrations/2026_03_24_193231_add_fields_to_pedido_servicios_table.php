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
        Schema::table('pedido_servicios', function (Blueprint $table) {
            $table->text('alcance')->nullable()->after('descripcion_servicio');
            $table->string('responsable')->nullable()->after('alcance');
            $table->text('entregables')->nullable()->after('responsable');
            $table->text('observaciones')->nullable()->after('entregables');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedido_servicios', function (Blueprint $table) {
            $table->dropColumn([
                'alcance',
                'responsable',
                'entregables',
                'observaciones',
            ]);
        });
    }
};
