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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->enum('tipo', ['palestra', 'workshop', 'curso', 'bate_papo', 'debate']);
            $table->enum('modalidade',['online', 'presencial', 'hibrido']);
            $table->enum('capacidade', ['ate_30', 'ate_50', 'ate_100', 'ate_200']);
            //$table->dateTime('inicio_evento');
            //$table->dateTime('fim_evento');
            $table->boolean('publicado')->default(false);
            //$table->integer('status')->default(1);


            //Divulgação
            //$table->string('image');
            $table->longText('description')->nullable;
            $table->string('endereco');
            $table->string('sala');
            $table->dateTime('data_comecar_evento');
            $table->dateTime('data_terminar_evento');

            //Convidado
            $table->string('nome_convidado');
            $table->string('especialidade');
            $table->longText('biografia')->nullable;
            $table->string('perfil_image');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
