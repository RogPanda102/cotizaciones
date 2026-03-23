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
        Schema::table('requisiciones', function (Blueprint $table) {
            $table->dropColumn('monto_estimado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requisiciones', function (Blueprint $table) {
            $table->decimal('monto_estimado', 10, 2)->nullable();
        });
    }
};
