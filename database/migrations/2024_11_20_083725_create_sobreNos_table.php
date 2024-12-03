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
        Schema::create('SobreNos', function (Blueprint $table) {
            $table->id();
            $table->string('tituloEvento');
            $table->string('imagemEvento');
            $table->longText('descricaoEvento')->nullable;
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SobreNos');
    }
};
