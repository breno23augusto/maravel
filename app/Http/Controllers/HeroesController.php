<?php

namespace App\Http\Controllers;

use App\Services\MarvelApi;
use Illuminate\Http\Request;

class HeroesController extends Controller
{
    private $marvelAPI;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MarvelApi $marvelAPI)
    {
        $this->marvelAPI = $marvelAPI;
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
        $heroes = $this->marvelAPI->nameStartsWith($request->input('hero-name'));
        return view('listHeroe', compact('heroes'));
    }
}
