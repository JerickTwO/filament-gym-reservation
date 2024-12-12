<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incripciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->foreignId('planes_id')->constrained()->onDelete('cascade');
            $table->foreignId('recepcionista_id')->constrained('users')->onDelete('cascade');
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->enum('status', ['ACTIVO', 'VENCIDO', 'SUSPENDIDO'])->default('ACTIVO');
            $table->string('metodo_pago')->nullable();
            $table->decimal('monto_pagado', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incripciones');
    }
};
