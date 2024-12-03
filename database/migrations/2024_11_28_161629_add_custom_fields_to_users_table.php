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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'sobrenome')) {
                $table->string('sobrenome');
            }

            if (!Schema::hasColumn('users', 'identificacao')) {
                $table->enum('identificacao', [
                    'Aluno da FATEC Campinas',
                    'Professor da FATEC Campinas',
                    'Visitante',
                ]);
            }

            if (Schema::hasColumn('users', 'curso')) {
                $table->enum('curso', ['ADS', 'GTI', 'PQ', 'LOG', 'GEEE', 'GE'])
                    ->nullable()
                    ->change();
            } else {
                $table->enum('curso', ['ADS', 'GTI', 'PQ', 'LOG', 'GEEE', 'GE'])
                    ->nullable();
            }

            if (Schema::hasColumn('users', 'semestre')) {
                $table->enum('semestre', ['1°', '2°', '3°', '4°', '5°', '6°'])
                    ->nullable()
                    ->change();
            } else {
                $table->enum('semestre', ['1°', '2°', '3°', '4°', '5°', '6°'])
                    ->nullable()
                    ->after('curso');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'sobrenome')) {
                $table->dropColumn('sobrenome');
            }

            if (Schema::hasColumn('users', 'identificacao')) {
                $table->dropColumn('identificacao');
            }

            if (Schema::hasColumn('users', 'curso')) {
                $table->dropColumn('curso');
            }

            if (Schema::hasColumn('users', 'semestre')) {
                $table->dropColumn('semestre');
            }
        });
    }
};
