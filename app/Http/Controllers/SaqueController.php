<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class SaqueController extends Controller
{
    
    public function index()
    {
        return view('saque');
    }

    public function processarSaque(Request $request)
    {
        $validated = $request->validate([
            'valor' => ['required', 'numeric', 'min:0.01', 'max:' . Auth::user()->saldo],
        ]);

        $user = Auth::user();

        if ($request->valor > $user->saldo) {
            return back()->withErrors(['valor' => 'Você não tem saldo suficiente para realizar este saque.']);
        }

        $user->saldo -= $request->valor;
        $user->save();

        return redirect()->route('saque.index')->with('status', 'Saque realizado com sucesso!');
    }
}

?>