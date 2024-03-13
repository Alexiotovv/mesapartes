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
        Schema::create('documentos_anexos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mesapartes_id')->unsigned();
            $table->foreign('mesapartes_id')->references('id')->on('mesapartes')->onDelete('cascade');
            $table->string('documento', 255)->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_anexos');
    }
};
