<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

//Não está funcionando
class VendaController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->is_admin) {
            $vendas = Venda::with('produto', 'comprador')->get();  
        } else {
            $vendas = Venda::where('vendedor_id', Auth::id())->get();
        }

        if ($request->data_inicio && $request->data_fim) {
            $vendas = $vendas->whereBetween('created_at', [
                Carbon::parse($request->data_inicio)->startOfDay(),
                Carbon::parse($request->data_fim)->endOfDay(),
            ]);
        }

        return view('vendas.index', compact('vendas'));
    }

    public function gerarPdf(Request $request)
    {
        $data_inicio = $request->data_inicio;
        $data_fim = $request->data_fim;
        if (Auth::user()->is_admin) {
            $vendas = Venda::with('produto', 'comprador')
                ->whereBetween('created_at', [
                    Carbon::parse($data_inicio)->startOfDay(),
                    Carbon::parse($data_fim)->endOfDay(),
                ])
                ->get();
        } else {
            $vendas = Venda::where('vendedor_id', Auth::id())
                ->whereBetween('created_at', [
                    Carbon::parse($data_inicio)->startOfDay(),
                    Carbon::parse($data_fim)->endOfDay(),
                ])
                ->get();
        }

        $pdf = PDF::loadView('pdf.vendas', compact('vendas'));
        return $pdf->download('relatorio_vendas.pdf');
    }
}
?>