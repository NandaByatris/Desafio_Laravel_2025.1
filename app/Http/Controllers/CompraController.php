<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CompraController extends Controller
{
    public function createCheckout(Request $request)
    {
        $url = config('services.pagseguro.checkout_url');
        $token = config('services.pagseguro.token');
    
        $produto_id = $request->produto_id;
        
        $produto = Produto::findOrFail($produto_id);
    
        $itens = [
            [
                'name' => $produto->nome,
                'quantidade' => 1,  
                'preco' => $produto->preco * 100, 
            ]
        ];
    
            $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])
        ->withoutVerifying()  
        ->post($url, [
            'user_id' => Auth::id(),  
            'itens' => $itens,        
        ]);
    
        if ($response->successful()) {
            Compra::create([
                'produto_id' => $produto->id,
                'comprador_id' => Auth::id(),  
                'vendedor_id' => $produto->user_id,  
                'valor_pago' => $produto->preco,  
                'status' => 'pendente',  
            ]);
    
            $pay_link = data_get($response->json(), 'links.1.href');
            
            if ($pay_link) {
                return redirect()->away($pay_link);
            } else {
                return redirect('/produtos')->with('error', 'Não foi possível gerar o link de pagamento.');
            }
        }
    
        $errorResponse = $response->json();  
        $errorMessage = isset($errorResponse['message']) ? $errorResponse['message'] : 'Erro desconhecido ao processar pagamento.';
        return redirect('/produtos')->with('error', $errorMessage);
    }
}
?>
