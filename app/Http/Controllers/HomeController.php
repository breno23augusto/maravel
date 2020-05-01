<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application all heroes.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function all()
    {
        $timestamp = Carbon::now()->timestamp;
        $apiUrl = env('MARVEL_API_URL');
        $apiPublicKey = env('MARVEL_API_PUBLIC_KEY');
        $apiPrivateKey = env('MARVEL_API_PRIVATE_KEY');
        $apiUrl .= "characters?ts={$timestamp}&apikey={$apiPublicKey}";
        $apiHash = md5($timestamp . $apiPrivateKey . $apiPublicKey);
        $apiUrl .= "&offset=" . rand(0, 1492) . "&hash={$apiHash}";

        $heroesJson = Http::get($apiUrl)
            ->json();

        $heroes = $heroesJson['data']['results'];

        return view('all', compact('heroes'));
    }


    /**
     * Search for a heroe.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $val = 'herói ' . $request->input('hero-name');
        return view('search', compact('val'));
    }
}
