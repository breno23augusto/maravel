<?php

namespace App\Http\Controllers;

use App\Models\MarvelApi;
use Illuminate\Http\Request;

class HeroesController extends Controller
{
    private $marvelAPI;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->marvelAPI = new MarvelApi();
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function some()
    {
        $heroes = $this->marvelAPI->getSomeHeroes();
        return view('listHeroe', compact('heroes'));
    }


    /**
     * Search for a heroe.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $heroeName = $request->input('hero-name');
        $heroes = $this->marvelAPI->nameStartsWith($heroeName);
        return view('listHeroe', compact('heroes'));
    }
}
