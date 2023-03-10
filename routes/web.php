<?php

use Illuminate\Support\Facades\Route;
use App\Mail\MensagemTesteMail;

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

Route::get('/', function () {
    return view('bem-vindo');
});

Auth::routes(['verify' => true]); // verificação de email para poder acessar ao sistema

Route::get('/tarefa/exportacao/{extensao}', [App\Http\Controllers\TarefaController::class, 'exportacao'])->name('tarefa.exportacao');

Route::resource('/tarefa', App\Http\Controllers\TarefaController::class)
    ->middleware('verified');

Route::get('/mensagem-teste', function(){
   return new MensagemTesteMail();
   //Mail::to('geraldodaniel013@gmail.com')->send(new MensagemTesteMail()); //enviar a mensagem
   //return 'Email enviado com sucesso!';
});
