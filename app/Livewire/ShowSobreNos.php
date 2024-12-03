<?php

namespace App\Livewire;

use App\Models\SobreNos;
use App\Models\PerguntasFrequentes;
use Livewire\Component;

class ShowSobreNos extends Component
{
    public function render()
    {
        $sobreNos = SobreNos::where('status',true)->orderBy('created_at', 'ASC')->first();
        $perguntasFrequentes = PerguntasFrequentes::where('status',true)->orderBy('question','ASC')->get();

        return view('livewire.show-sobre-nos',[
            'sobreNos' => $sobreNos,
            'perguntasFrequentes' => $perguntasFrequentes
        ]);


    }
}
