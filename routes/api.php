<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('games', GameController::class)->only(['index']);

Route::post('/games/love', [GameController::class, 'love']);
Route::post('/games/unlove', [GameController::class, 'unlove']);

Route::get('/players/{player}/loved-games', [PlayerController::class, 'getAllLovedGames']);

Route::get('/games/most-loved', [GameController::class, 'getMostLoved']);
