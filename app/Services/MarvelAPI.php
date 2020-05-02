<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class MarvelApi
{
    private $timestamp;
    private $publicKey;
    private $privateKey;
    private $baseURL;

    const minOffset = 0;
    const maxOffset = 1000;


    /**
     * Create a new MarvelAPI instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->timestamp = Carbon::now()->timestamp;
        $this->publicKey = env('MARVEL_API_PUBLIC_KEY');
        $this->privateKey = env('MARVEL_API_PRIVATE_KEY');
        $this->baseURL = env('MARVEL_API_URL');
    }

    public function getSomeHeroes()
    {
        $randOffset = rand(self::minOffset, self::maxOffset);

        $apiUrl = $this->baseURL;
        $apiUrl .= $this->getApiBaseURlForHeroe();
        $apiUrl .= "&offset=" . $randOffset;
        $apiUrl .= "&limit=50";

        $heroesJson = Http::get($apiUrl)->json();
        return $heroesJson['data']['results'];
    }

    public function nameStartsWith($name)
    {
        $apiUrl = $this->baseURL;
        $apiUrl .= $this->getApiBaseURlForHeroe();
        $apiUrl .= "&nameStartsWith={$name}";
        $apiUrl .= "&limit=50";

        $heroeJson = Http::get($apiUrl)->json();
        return $heroeJson['data']['results'];
    }

    public function getApiBaseURlForHeroe()
    {
        $apiHash = $this->getAPIHash();
        $apiUrl = "characters?";
        $apiUrl .= "ts={$this->timestamp}";
        $apiUrl .= "&apikey={$this->publicKey}";
        $apiUrl .= "&hash={$apiHash}";
        return $apiUrl;
    }

    public function getAPIHash()
    {
        return md5($this->timestamp . $this->privateKey . $this->publicKey);
    }
}
