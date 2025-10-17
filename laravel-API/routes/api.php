<?php

use App\Http\Controllers\TokenAuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/tokens/create', [TokenAuthenticationController::class, 'store'])->middleware('guest');

Route::middleware('auth:sanctum')->group(function () {
    
    // Rota para obter o usuário autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Rota para deletar o token (logout)
    Route::post('tokens/delete', [TokenAuthenticationController::class, 'destroy']);

    // Rotas do CRUD de Usuários
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}',[UserController::class, 'update']);
    Route::delete('/users/{user}',[UserController::class, 'destroy']);
});

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});