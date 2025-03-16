<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SaqueController;
use App\Models\Categoria;
use App\Models\Produto;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produto/{produto}', [ProdutoController::class, 'show'])->name('produtos.show');


Route::get('/dashboard', function () {
    $categorias = Categoria::all();
    $produtos = Produto::paginate(10);  
    return view('dashboard', compact('categorias', 'produtos'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::post('/compra/{produto}', [CompraController::class, 'create'])->name('compra.create');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/saque', [SaqueController::class, 'index'])->name('saque.index');
    Route::post('/saque/processar', [SaqueController::class, 'processarSaque'])->name('saque.processar');
});

require __DIR__.'/auth.php';

?>