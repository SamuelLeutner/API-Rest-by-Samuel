<?php

use App\Http\Controllers\ExploradorAuthController;
use App\Http\Controllers\ExploradorController;
use App\Http\Controllers\HistoricoLocalizacaoController;
use App\Http\Controllers\ItemInventarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [ExploradorAuthController::class, 'login']);

// Cria explorador
Route::post('/exploradores', [ExploradorAuthController::class, 'registro']);

Route::middleware('auth:sanctum')->group(function () {

    Route::put('/exploradores/{id}', [ExploradorController::class, 'update']);

    Route::post('/exploradores/{id}/inventario', [ItemInventarioController::class, 'addItens']);

    Route::post('/exploradores/trocar', [ItemInventarioController::class, 'trocarItens']);

    Route::get('/exploradores/{id}', [ExploradorController::class, 'show']);

    Route::get('/exploradores/{id}/historico', [HistoricoLocalizacaoController::class, 'historico']);

    Route::get('/relatorios', [ExploradorController::class, 'relatorios']);
});

