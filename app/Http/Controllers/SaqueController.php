<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class SaqueController extends Controller
{
    /**
     * Exibe a página de saque.
     */
    public function index()
    {
        return view('saque');
    }

    /**
     * Processa o saque do usuário.
     */
    public function processarSaque(Request $request)
    {
        // Valida o valor do saque
        $validated = $request->validate([
            'valor' => ['required', 'numeric', 'min:0.01', 'max:' . Auth::user()->saldo],
        ]);

        // Obtem o usuário logado
        $user = Auth::user();

        // Verifica se o saldo é suficiente
        if ($request->valor > $user->saldo) {
            return back()->withErrors(['valor' => 'Você não tem saldo suficiente para realizar este saque.']);
        }

        // Realiza o saque
        $user->saldo -= $request->valor;
        $user->save();

        // Retorna para a página de saque com uma mensagem de sucesso
        return redirect()->route('saque.index')->with('status', 'Saque realizado com sucesso!');
    }
}

?>