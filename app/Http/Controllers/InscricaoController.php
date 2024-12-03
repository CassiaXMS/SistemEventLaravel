<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscricao;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;

class InscricaoController extends Controller
{
    public function inscrever(Request $request, $eventoId)
    {
        $user = Auth::user();
        $evento = Evento::findOrFail($eventoId);

        // Verificar se o usuário já está inscrito
        if (Inscricao::where('user_id', $user->id)->where('evento_id', $eventoId)->exists()) {
            return redirect()->back()->with('error', 'Você já está inscrito neste evento!');
        }

        // Criar a inscrição
        Inscricao::create([
            'user_id' => $user->id,
            'evento_id' => $eventoId,

        ]);
        session()->flash('success', 'Inscrição realizada com sucesso!');
        return redirect()->route('eventoDetalhes', $evento->id);
        // return redirect()->back()->with('success', 'Inscrição realizada com sucesso!');
    }

    // Método para cancelar a inscrição
    public function cancelarInscricao($eventoId)
    {
        $evento = Evento::findOrFail($eventoId);

        // Verifica se o usuário está inscrito neste evento
        $inscricao = $evento->inscricoes()->where('user_id', auth()->id())->first();

        if ($inscricao) {
            $inscricao->delete(); // Cancela a inscrição
            session()->flash('success', 'Inscrição cancelada com sucesso!');
        } else {
            session()->flash('error', 'Você não está inscrito neste evento.');
        }

        return redirect()->route('eventoDetalhes', $evento->id);

    }
    
}
