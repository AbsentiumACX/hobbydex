<?php

namespace App\Http\Controllers;

use App\Models\Pokedex;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PokedexController extends Controller
{
    /**
     * Store a new pokedex in the database.
     *
     * @param Request $request
     * @return Response
     */
    public function store (Request $request)
    {
        $request->validate([
            'character_id' => 'required',
            'generation' => 'required|numeric',
        ]);

        $generations = array();

        for ($iteration = 1; $iteration <= $request->generation; $iteration++) {
            array_push($generations, $iteration);
        }
        $caughtPokemon = array();

        try {
            Pokedex::create([
                'generations' => $generations,
                'caught_pokemon' => $caughtPokemon,
                'character_id' => $request['character_id'],
            ]);
            return response(['message' => 'Success']);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    /**
     * Update the caught_pokemon array in the database.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update (Request $request, int $id)
    {
        $pokedex = Pokedex::findOrFail($id);
        $pokemon_id = $request->pokemon_id;
        //dd($request);
        $caught_pokemon = $pokedex->caught_pokemon;
        if (array_key_exists($pokemon_id, $caught_pokemon)) {
            unset($caught_pokemon[$pokemon_id]);
        } else {
            $pokemon = Pokemon::findOrFail($request['pokemon_id']);
            $caught_pokemon[$pokemon_id] = $pokemon->name;
        }

        $pokedex->caught_pokemon = $caught_pokemon;

        try {
            $pokedex->save();
            return response(['message' => 'Success']);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    /**
     * Remove the specified pokedex from the database.
     *
     * @param Integer $id
     * @return Response
     */
    public function destroy (int $id)
    {
        $pokedex = Pokedex::findOrFail($id);
        try {
            $pokedex->delete();
            return response(['message' => 'Success']);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }
}
