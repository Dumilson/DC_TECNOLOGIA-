<?php

use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\ClientesController;
use App\Http\Controllers\Admin\ProdutosController;
use App\Http\Controllers\Admin\UsuariosController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => '/'
], function(){
    Route::get('/', [LoginController::class , 'index'])->name('login');
    Route::get('/sair', [LoginController::class , 'logout'])->name('logout');
    Route::post('/login', [LoginController::class , 'autenticate'])->name('login.user');
});


Route::group([
    'prefix' => 'produtos',
     'middleware' => ['auth']
], function(){
    Route::get('/', [ProdutosController::class , 'index'])->name('index.produtos');
    Route::post('/', [ProdutosController::class , 'store'])->name('store.produto');
});

Route::group([
    'prefix' => 'carrinho',
     'middleware' => ['auth']
], function(){
    Route::get('/add/{id_produto?}/{quant?}', [CartController::class , 'index'])->name('index.produtos');
    Route::post('/', [ProdutosController::class , 'store'])->name('store.produto');
});


Route::group([
    'prefix' => 'clientes',
     'middleware' => ['auth']
], function(){
    Route::get('/', [ClientesController::class , 'index'])->name('index.clientes');
    Route::post('/', [ClientesController::class , 'store'])->name('store.cliente');
});


Route::group([
    'prefix' => 'users',
     'middleware' => ['auth']
], function(){
    Route::get('/', [UsuariosController::class , 'index'])->name('index.usuario');
    Route::post('/', [UsuariosController::class , 'store'])->name('store.usuario');
});
