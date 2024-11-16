<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Categoria;
use Livewire\Attributes\Url;

class ShowHome extends Component
{

    #[Url]
    public $categoriaSlug = null;

    public function render()
    {
        $categorias = Categoria::all();

        $paginate = 10; // Defina a quantidade de itens por página


        $categorias = Categoria::whereHas('eventos', function($query) {
            $query->where('publicado', 1);
        })->get();


        // Verifica se há uma categoria selecionada
        if (!empty($this->categoriaSlug) && $this->categoriaSlug !== 'todos') {
            $categoria = Categoria::where('slug', $this->categoriaSlug)->first();

            if (empty($categoria)) {
                abort(404);
            }

            $eventos = Evento::orderBy('created_at', 'DESC')
            ->where('categoria_id', $categoria->id)
            ->where('publicado', 1) // Apenas eventos ativos
            ->paginate($paginate);

            // Filtra os eventos pela categoria selecionada
            // $eventos = Evento::where('categoria_id', $categoria->id)
            //     ->where('status', 1)
            //     ->orderBy('created_at', 'DESC')
            //     ->paginate($paginate);


            // $eventos = Evento::orderBY('created_at', 'DESC')
            //     ->where('categoria_id',$categoria->id)
            //     ->paginate(2);
        }else{
            //$eventos = Evento::orderBY('created_at', 'DESC')->paginate(2);

            // // Exibe todos os eventos se nenhuma categoria estiver selecionada
            // $eventos = Evento::where('status', 1)
            //     ->orderBy('created_at', 'DESC')
            //     ->paginate($paginate);

            $eventos = Evento::orderBY('created_at','DESC')
            ->where('publicado',1)
            ->paginate($paginate);
        }



        $latestEventos = Evento::orderBY('created_at','DESC')
            ->where('publicado',1)
            ->get()
            ->take(3);


        return view('livewire.show-home', [
            'eventos' => $eventos,
            'latestEventos' => $latestEventos,
            'categorias' => $categorias
        ]);

    }

}
