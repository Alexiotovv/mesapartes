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
        Schema::create('mesapartes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('id_tipodocumentos')->unsigned();
            $table->foreign('id_tipodocumentos')->references('id')->on('tipo_documentos')->onDelete('cascade');
            $table->string('numero_documento', 100)->default('');
            $table->string('asunto', 900)->default('');
            $table->string('atencion', 300)->default('');
            $table->string('comentarios', 250)->default('');
            $table->string('documento_principal', 500)->default('');
            $table->integer('nro_folios')->default(0);
            $table->date('fecha');
            $table->time('hora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesapartes');
    }
};
