<?php 

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class ProductSeeder extends Seeder{

    public function run(): void{


        $categoria = Categoria::first(); 
        if (!$categoria) {
            $categoria = Categoria::create(['nome' => 'Categoria Padrão']); 
        }

        Produto::create([
            'nome' => "Tal",
            'preco' => 248.85,
            'quantidade' => 1,
            'imagem' => "imagem/ceu.png",
            'categoria_id' => $categoria->id,
        ]);

        Produto::create([
            'nome' => "Algum",
            'preco' => 8954.88,
            'quantidade' => 7,
            'imagem' => "imagem/ceu.png",
            'categoria_id' => $categoria->id,
        ]);
    }
}

?>