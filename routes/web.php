<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SaqueController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Api\UserController;
use App\Models\Categoria;
use App\Models\Produto;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/checkout', [CompraController::class, 'createCheckout'])->name('checkout')->middleware('auth');

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
Route::middleware('auth')->group(function () {
    Route::get('/historico-compras', [CompraController::class, 'index'])->name('compras.index');
    Route::post('/historico-compras/pdf', [CompraController::class, 'gerarPDF'])->name('compras.pdf');
 }); 

 Route::middleware(['auth'])->group(function () {
    Route::get('/vendas', [VendaController::class, 'index'])->name('vendas.index');
    Route::post('/vendas/pdf', [VendaController::class, 'gerarPdf'])->name('vendas.pdf');
});

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/saque', [SaqueController::class, 'index'])->name('saque.index');
    Route::post('/saque/processar', [SaqueController::class, 'processarSaque'])->name('saque.processar');
});

//CRUD de produtos
Route::middleware('auth')->group(function () {
    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
    Route::get('/produto/{produto}', [ProdutoController::class, 'show'])->name('produtos.show');
    Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::get('/produtos/{produto}/edit', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::put('/produtos/{produto}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
});

Route::get('/email', [EmailController::class, 'index'])->name('email.index');
Route::post('/email', [EmailController::class, 'store'])->name('email.store');

Route::get('/users', [UserController::class, 'getUsers']);
Route::get('/admins', [UserController::class, 'getAdmins']);


require __DIR__.'/auth.php';

?>