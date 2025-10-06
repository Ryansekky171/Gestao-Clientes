<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('contas_bancarias', function (Blueprint $table) {
            $table->id();
            $table->string('banco');
            $table->string('agencia');
            $table->string('conta');
            $table->string('tipo');
            $table->foreignId('estabelecimento_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('contas_bancarias');
    }
};