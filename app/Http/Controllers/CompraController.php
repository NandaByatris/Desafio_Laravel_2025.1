<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Produto;  
use Illuminate\Http\Request;


class CompraController extends Controller
{
    public function create($produtoId)
    {
        $produto = Produto::findOrFail($produtoId);


        return view('compra.create', compact('produto'));
    }
}


?>
 