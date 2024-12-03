<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Inscricao;


class EventoDetalhes extends Component
{
    public $eventoID = null;
    public $inscrito = false;

    public function mount($id)
    {
        $this->eventoID = $id;

        // Verifica se o usuário está inscrito
        $evento = Evento::findOrFail($this->eventoID);
        $this->inscrito = $evento->inscricoes()->where('user_id', auth()->id())->exists();
    }

    public function inscrever()
    {
        $evento = Evento::findOrFail($this->eventoID);

        // Verifica se o usuário já está inscrito
        if ($evento->inscricoes()->where('user_id', auth()->id())->exists()) {
            session()->flash('error', 'Você já está inscrito neste evento.');
            return;
        }

        // Cria a inscrição
        $evento->inscricoes()->create([
            'user_id' => auth()->id(),
            'evento_id' => $evento->id,
        ]);

        // Mensagem de sucesso
        session()->flash('success', 'Inscrição realizada com sucesso!');

        // Atualiza o estado da variável inscrito
        $this->inscrito = true;
        }

    public function cancelarInscricao()
    {
        $evento = Evento::findOrFail($this->eventoID);

        // Verifica se o usuário está inscrito antes de tentar cancelar
        $inscricao = $evento->inscricoes()->where('user_id', auth()->id())->first();

        if ($inscricao) {
            $inscricao->delete(); // Remove a inscrição
            session()->flash('success', 'Inscrição cancelada com sucesso!');
            $this->inscrito = false; // Atualiza o estado de inscrito
        }
    }


    // public $eventoID = null;

    // public function mount($id) {
    //     $this->eventoID = $id;
    // }

    public function render()
    {
        $evento = Evento::findOrFail($this->eventoID);
        return view('livewire.evento-detalhes',[
            'evento' => $evento,

        ]);
    }
}
