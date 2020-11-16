<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the characters.
     *
     * @return Response
     */
    public function index ()
    {
        $currentUser = Auth::id();
        $characters = Character::where('user_id', '=', $currentUser)->get();
        return view('character.index', ['characters' => $characters]);
    }

    /**
     * Show the form for creating a new character.
     *
     * @return Response
     */
    public function create ()
    {
        return view('character.create');
    }

    /**
     * Store a new character in the database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store (Request $request)
    {
        $request->validate([
            'name' => 'required',
            'generation' => 'required|numeric|min:1|max:8',
        ]);

        $request->request->add(['user_id' => Auth::id()]);

        try {
            $character = Character::create($request->all());
            $apiRequest = $this->createPokedexStoreRequest($character->generation, $character->id);
            try {
                $apiResponse = app()->handle($apiRequest);
                return redirect()->route('character.index')
                    ->with('success', 'Character ' . $request['name'] . ' created successfully.');
            } catch (\Exception $e) {
                return response($e->getMessage());
            }
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    /**
     * Create a request for storing a new pokedex during character creation.
     *
     * @param int $generation
     * @param int $characterId
     * @return Request
     */
    private function createPokedexStoreRequest (int $generation, int $characterId)
    {
        return Request::create('/api/pokedex', 'POST',
            ['generation' => $generation, 'character_id' => $characterId], [], [], $_SERVER);
    }

    /**
     * Display the character.
     *
     * @param Character $character
     * @return Response
     */
    public function show (Character $character)
    {
        $pokedex = $character->pokedex()->first();

        return view('character.show')
            ->with(compact('character'))
            ->with(compact('pokedex'));
    }

    /**
     * Remove the specified character and pokedex from the database.
     *
     * @param Character $character
     * @return RedirectResponse
     */
    public function destroy (Character $character)
    {
        $characterName = $character->name;
        try {
            $pokedex = $character->pokedex()->first();
            $destroyRequest = $this->createPokedexDestroyRequest($pokedex->id);
            try {
                $destroyResponse = app()->handle($destroyRequest);
            } catch (\Exception $e) {
                return response($e->getMessage());
            }

            $character->delete();
            return redirect()->route('character.index')
                ->with('success', 'Character ' . $characterName . ' deleted successfully');
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    /**
     * Create a request for destroying a pokedex during character destruction
     *
     * @param int $id
     * @return Request
     */
    private function createPokedexDestroyRequest (int $id)
    {
        return Request::create('/api/pokedex/' . $id, 'DELETE',
            [], [], [], $_SERVER);
    }
}
