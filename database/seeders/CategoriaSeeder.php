<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{

    public function run(): void
    {

       // Categoria::truncate();

        $categorias = [
            ['nome' => 'Administração', 'slug' => 'administracao'],
            ['nome' => 'Culinária', 'slug' => 'culinaria'],
            ['nome' => 'Ciência', 'slug' => 'ciencia'],
            ['nome' => 'Educação', 'slug' => 'educacao'],
            ['nome' => 'Energia', 'slug' => 'energia'],
            ['nome' => 'Esporte', 'slug' => 'esporte'],
            ['nome' => 'Finanças', 'slug' => 'financas'],
            ['nome' => 'Gestão de Projetos', 'slug' => 'gestao-de-projetos'],
            ['nome' => 'Inteligência Artificial', 'slug' => 'inteligencia-artificial'],
            ['nome' => 'Logística', 'slug' => 'logistica'],
            ['nome' => 'Linguagem', 'slug' => 'linguagem'],
            ['nome' => 'Marketing', 'slug' => 'marketing'],
            ['nome' => 'Meio Ambiente', 'slug' => 'meio-ambiente'],
            ['nome' => 'Música', 'slug' => 'musica'],
            ['nome' => 'Pessoal', 'slug' => 'pessoal'],
            ['nome' => 'Produção', 'slug' => 'produca'],
            ['nome' => 'Psicologia', 'slug' => 'psicologia'],
            ['nome' => 'Química', 'slug' => 'quimica'],
            ['nome' => 'Robótica', 'slug' => 'robotica'],
            ['nome' => 'Saúde', 'slug' => 'saude'],
            ['nome' => 'Tecnologia', 'slug' => 'tecnologia'],
            ['nome' => 'Trabalho', 'slug' => 'trabalho'],
            ['nome' => 'Entretenimento', 'slug' => 'entretenimento'],
        ];


        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
