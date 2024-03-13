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
        Schema::create('userdetails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('id_tipopersona')->unsigned();
            $table->foreign('id_tipopersona')->references('id')->on('tipo_personas')->onDelete('cascade');
            $table->bigInteger('id_tipodocumentoidentidad')->unsigned();
            $table->foreign('id_tipodocumentoidentidad')->references('id')->on('tipo_documentosidentidades')->onDelete('cascade');
            $table->string('dni_ce', 15)->default('');
            $table->string('nombre', 250)->default('');
            $table->string('ap_paterno', 250)->default('');
            $table->string('ap_materno', 250)->default('');
            $table->string('ruc_entidad', 15)->default('');
            $table->string('telefono', 100)->default('');
            $table->string('direccion', 250)->default('');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userdetails');
    }
};
