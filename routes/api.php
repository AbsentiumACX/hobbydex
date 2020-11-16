<?php

use App\Http\Controllers\PokedexController;
use App\Http\Controllers\PokemonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
/** Pokédex Routes */
Route::get('/pokedex/{character_id}', [PokedexController::class, 'show'])->name('api.pokedex.show');
Route::post('/pokedex', [PokedexController::class, 'store'])->name('api.pokedex.store');
Route::post('/pokedex/{id}', [PokedexController::class, 'update'])->name('api.pokedex.update');
Route::delete('/pokedex/{id}', [PokedexController::class, 'destroy'])->name('api.pokedex.destroy');

/** Pokémon Routes */
Route::get('/pokemon/{generation}', [PokemonController::class, 'show'])->name('api.pokemon.show');