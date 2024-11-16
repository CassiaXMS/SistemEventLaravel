<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Evento;

class EventoDetalhes extends Component
{
    public $eventoID = null;

    public function mount($id) {
        $this->eventoID = $id;
    }

    public function render()
    {
        $evento = Evento::findOrFail($this->eventoID);
        return view('livewire.evento-detalhes',[
            'evento' => $evento
        ]);
    }
}
