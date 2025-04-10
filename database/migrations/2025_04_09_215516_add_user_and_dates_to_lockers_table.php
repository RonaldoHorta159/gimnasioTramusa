<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lockers', function (Blueprint $table) {
            if (!Schema::hasColumn('lockers', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('lockers', 'fecha_inicio_membresia')) {
                $table->date('fecha_inicio_membresia')->nullable();
            }
            if (!Schema::hasColumn('lockers', 'fecha_fin_membresia')) {
                $table->date('fecha_fin_membresia')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lockers', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('fecha_inicio_membresia');
            $table->dropColumn('fecha_fin_membresia');
        });
    }
};
