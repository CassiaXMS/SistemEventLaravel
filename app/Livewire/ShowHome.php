<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Categoria;
use App\Models\SobreNos;
use Livewire\Attributes\Url;

class ShowHome extends Component
{

    public $categoriaSlug = 'todos'; // Valor padrão para 'todos' os eventos

    public function mount($categoriaSlug = 'todos')
    {
        // Se o parâmetro 'categoriaSlug' for passado na URL, ele será atualizado aqui
        $this->categoriaSlug = $categoriaSlug;
    }
    public function filterEvents($slug)
    {
        $this->categoriaSlug = $slug;
    }
    


    public function render()
    {


        $sobreNos = SobreNos::where('status', true)
            ->orderBy('created_at', 'ASC')
            ->first();

        // Carregar categorias com eventos ativos
        $categorias = Categoria::whereHas('eventos', function ($query) {
            $query->where('publicado', 1);
        })->withCount(['eventos as eventos_count' => function ($query) {
            $query->where('publicado', 1); // Conta apenas os eventos publicados
        }])->get();

        // Contar o número total de eventos ativos
        $totalEventos = Evento::where('publicado', 1)->count();

        $paginate = 10; // Quantidade de itens por página

        // Filtra os eventos de acordo com a categoria
        if ($this->categoriaSlug !== 'todos') {
            // Se a categoria não for 'todos', filtra pelos eventos dessa categoria
            $categoria = Categoria::where('slug', $this->categoriaSlug)->first();

            if (!$categoria) {
                abort(404); // Caso a categoria não exista
            }

            $eventos = Evento::where('categoria_id', $categoria->id)
                ->where('publicado', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate($paginate);
        } else {
            // Exibe todos os eventos se a categoria for 'todos'
            $eventos = Evento::where('publicado', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate($paginate);
        }

        // Carregar os 3 últimos eventos
        $latestEventos = Evento::where('publicado', 1)
            ->orderBy('created_at', 'DESC')
            ->take(3)
            ->get();

        return view('livewire.show-home', [
            'sobreNos' => $sobreNos,
            'eventos' => $eventos,
            'latestEventos' => $latestEventos,
            'categorias' => $categorias,
            'totalEventos' => $totalEventos
        ]);

    }
}

    // #[Url]
    // public $categoriaSlug = null;

    // public function render()
    // {
    //     $sobreNos = SobreNos::where('status',true)->orderBy('created_at', 'ASC')->first();

    //     $categorias = Categoria::all();

    //     $paginate = 10; // Defina a quantidade de itens por página


    //     $categorias = Categoria::whereHas('eventos', function($query) {
    //         $query->where('publicado', 1);
    //     })->get();


    //     // Verifica se há uma categoria selecionada
    //     if (!empty($this->categoriaSlug) && $this->categoriaSlug !== 'todos') {
    //         $categoria = Categoria::where('slug', $this->categoriaSlug)->first();

    //         if (empty($categoria)) {
    //             abort(404);
    //         }

    //         $eventos = Evento::orderBy('created_at', 'DESC')
    //         ->where('categoria_id', $categoria->id)
    //         ->where('publicado', 1) // Apenas eventos ativos
    //         ->paginate($paginate);

    //         // Filtra os eventos pela categoria selecionada
    //         // $eventos = Evento::where('categoria_id', $categoria->id)
    //         //     ->where('status', 1)
    //         //     ->orderBy('created_at', 'DESC')
    //         //     ->paginate($paginate);


    //         // $eventos = Evento::orderBY('created_at', 'DESC')
    //         //     ->where('categoria_id',$categoria->id)
    //         //     ->paginate(2);
    //     }else{
    //         //$eventos = Evento::orderBY('created_at', 'DESC')->paginate(2);

    //         // // Exibe todos os eventos se nenhuma categoria estiver selecionada
    //         // $eventos = Evento::where('status', 1)
    //         //     ->orderBy('created_at', 'DESC')
    //         //     ->paginate($paginate);

    //         $eventos = Evento::orderBY('created_at','DESC')
    //         ->where('publicado',1)
    //         ->paginate($paginate);
    //     }



    //     $latestEventos = Evento::orderBY('created_at','DESC')
    //         ->where('publicado',1)
    //         ->get()
    //         ->take(3);


    //     return view('livewire.show-home', [
    //         'sobreNos' => $sobreNos,
    //         'eventos' => $eventos,
    //         'latestEventos' => $latestEventos,
    //         'categorias' => $categorias
    //     ]);

    // }






