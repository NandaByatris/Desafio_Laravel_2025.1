<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Já tinha, não precisa mexer
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



//CRUD de produtos
public function create()
    {
        if (Auth::user()->is_admin) {
            return redirect()->route('produtos.index')->with('error', 'Você não tem permissão para criar produtos.');
        }

        $categorias = Categoria::all(); 
        return view('create-produto', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descricao' => 'nullable|string',
            'categoria_id' => 'required|exists:categoria,id',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
        ]);

        if (Auth::user()->is_admin) {
            return redirect()->route('produtos.index')->with('error', 'Você não tem permissão para criar produtos.');
        }
        $imagemPath = $request->file('imagem')->store('public/imagens_produtos');

        // Cria o produto
        Produto::create([
            'nome' => $request->nome,
            'imagem' => $imagemPath,
            'descricao' => $request->descricao,
            'categoria_id' => $request->categoria_id,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        if ($produto->user_id !== Auth::id() && !Auth::user()->is_admin) {
            return redirect()->route('produtos.index')->with('error', 'Você não tem permissão para editar este produto.');
        }

        $categorias = Categoria::all();
        return view('edit-produto', compact('produto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'descricao' => 'nullable|string',
            'categoria_id' => 'required|exists:categoria,id',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
        ]);

        $produto = Produto::findOrFail($id);
        if ($produto->user_id !== Auth::id() && !Auth::user()->is_admin) {
            return redirect()->route('produtos.index')->with('error', 'Você não tem permissão para editar este produto.');
        }

        if ($request->hasFile('imagem')) {
            $imagemPath = $request->file('imagem')->store('public/imagens_produtos');
            $produto->imagem = $imagemPath;
        }

        $produto->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'categoria_id' => $request->categoria_id,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }



    //Já tinha, não precisa mexer
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
            if ($produto->user_id !== Auth::id()) {
            return redirect()->route('produtos.index')->with('error', 'Você não tem permissão para excluir este produto.');
        }
            $produto->delete();
    
        return redirect()->route('produtos.index')->with('status', 'Produto deletado com sucesso!');
    }
    

    public function show($id){
        $produto = Produto::with(['categoria', 'user'])->findOrFail($id); 
        $vendedor = $produto->user; 
        return view('show', compact('produto', 'vendedor')); 
    }

}
?>