<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CriptomoedasController;

//Rotas para visualizar os registros (get)
Route::get('/',function(){return response()->json(['Sucesso'=>true]);});
Route::get('/cripto',[CriptomoedasController::class,'index']);
Route::get('/cripto/{codigo}',[CriptomoedasController::class,'show']);

//Rota para inserir registros (post)
Route::post('/cripto',[CriptomoedasController::class,'store']);

//Rota para alterar os registros (put)
Route::put('/cripto/{id}',[CriptomoedasController::class,'update']);

//Rota para excluir o resgistro (delete)
Route::delete('/cripto/{id}',[CriptomoedasController::class,'destroy']);