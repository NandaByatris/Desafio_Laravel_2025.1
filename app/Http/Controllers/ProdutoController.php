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
public function destroy($id)
{
    $produto = Produto::findOrFail($id);

    // Somente o usuário que criou o produto pode deletar ou o admin
    if ($produto->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
        return redirect()->route('produtos.index')->with('error', 'Você não tem permissão para excluir este produto.');
    }

    // Deleta a imagem associada ao produto
    if ($produto->imagem) {
        \Storage::disk('public')->delete($produto->imagem);
    }

    $produto->delete();

    return redirect()->route('produtos.index')->with('status', 'Produto deletado com sucesso!');
}


    public function show($id){
        $produto = Produto::with(['categoria', 'user'])->findOrFail($id);
        return view('show', compact('produto'));
    }
}
?>