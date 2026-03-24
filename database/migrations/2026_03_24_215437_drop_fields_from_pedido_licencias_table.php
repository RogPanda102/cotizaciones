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
            $table->dropColumn(['estado', 'clave_licencia']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedido_licencias', function (Blueprint $table) {
            $table->string('estado')->nullable();
            $table->string('clave_licencia')->nullable();
        });
    }
};
