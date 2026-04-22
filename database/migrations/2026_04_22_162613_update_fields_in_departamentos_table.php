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
        Schema::table('departamentos', function (Blueprint $table) {
            $table->renameColumn('contacto', 'responsable');
        });

        Schema::table('departamentos', function (Blueprint $table) {
            $table->foreignId('dependencia_id')
                ->nullable()
                ->after('id')
                ->constrained('dependencias')
                ->nullOnDelete();

            $table->string('nombre_departamento', 255)->nullable()->after('dependencia_id');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departamentos', function (Blueprint $table) {
            $table->renameColumn('responsable', 'contacto');
        });
        Schema::table('departamentos', function (Blueprint $table) {
            $table->dropForeign(['dependencia_id']);
            $table->dropColumn('dependencia_id');
            $table->dropColumn('nombre_departamento');
        });
    }
};
