<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Response;

class PokemonController extends Controller
{
    /**
     * Display all Pokémon defined by generation.
     *
     * @param int $generation
     * @return Response
     */
    public function show (int $generation)
    {
        $pokemonList = Pokemon::where('generation', '=', $generation)->get();

        return response(['pokemons' => $pokemonList]);
    }
}
