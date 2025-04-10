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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nrodocumento')->unique();  // Documento de identificación
            $table->string('nombrecompleto');
            $table->date('fechadenacimiento');
            $table->enum('residencia', ['nacional', 'residente']); // Tipo de residencia
            $table->enum('tipo_membresia', ['por_dia', 'por_meses']); // Tipo de membresía
            $table->date('fecha_inicio_membresia');
            $table->date('fecha_fin_membresia');
            $table->foreignId('locker_id')->nullable()->constrained('lockers')->onDelete('set null'); // Relación con la tabla lockers

            // Eliminar columnas existentes
            $table->dropColumn('password');
            $table->dropColumn('email_verified_at');
            $table->dropColumn('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nrodocumento');
            $table->dropColumn('nombrecompleto');
            $table->dropColumn('fechadenacimiento');
            $table->dropColumn('residencia');
            $table->dropColumn('tipo_membresia');
            $table->dropColumn('fecha_inicio_membresia');
            $table->dropColumn('fecha_fin_membresia');
            $table->dropForeign(['locker_id']); // Eliminar la clave foránea
            $table->dropColumn('locker_id');

            // Restaurar columnas eliminadas
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });
    }
};