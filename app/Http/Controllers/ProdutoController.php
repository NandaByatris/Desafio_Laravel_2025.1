<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    public function index(Request $request){
    $categorias = Categoria::all(); 
    $produtos = Produto::when($request->search, function ($query) use ($request) {
        return $query->where('nome', 'like', '%' . $request->search . '%');
    })
    ->when($request->categoria, function ($query) use ($request) {
        return $query->where('categoria_id', $request->categoria); 
    })->paginate(9);
    return view('dashboard', compact('categorias', 'produtos'));
}

/* public function createCompra($id)
{
    $produto = Produto::findOrFail($id);
    $user = Auth::user();
    $user->saldo += $produto->preco;
    $user->save();
    return redirect()->route('produtos.index')->with('success', 'Compra realizada com sucesso!');
} */


    public function show($id){
        $produto = Produto::with(['categoria', 'user'])->findOrFail($id);
        return view('show', compact('produto'));
    }
}
?>