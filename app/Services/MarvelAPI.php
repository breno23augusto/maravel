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

        $url = self::concactURL(
            [
                $this->getApiBaseUrlForHeoes(),
                $this->bindParameter('offset', $randOffset),
                $this->bindParameter('limit', 50)
            ]
        );

        return self::prepareResult(Http::get($url)->json());
    }

    public function nameStartsWith($name)
    {

        $url = self::concactURL(
            [
                $this->getApiBaseUrlForHeoes(),
                $this->bindParameter('nameStartsWith', $name),
                $this->bindParameter('limit', 50)
            ]
        );

        return self::prepareResult(Http::get($url)->json());
    }

    private function getApiBaseUrlForHeoes()
    {
        $url = self::concactURL(
            [
                $this->baseURL,
                "characters?ts={$this->timestamp}",
                $this->bindParameter('apikey', $this->publicKey),
                $this->bindParameter('hash', $this->getAPIHash())
            ]
        );
        return $url;
    }

    private function bindParameter($string, $value)
    {
        return "&{$string}={$value}";
    }

    private static function concactURL(array $values)
    {
        return implode('', $values);
    }

    public function getAPIHash()
    {
        return md5($this->timestamp . $this->privateKey . $this->publicKey);
    }

    public static function prepareResult($result)
    {
        if ($result['code'] == 200) {
            return $result['data']['results'];
        } else {
            return self::getNotFoundCharactere();
        }
    }

    private static function getNotFoundCharactere()
    {
        return [
            0 => [
                "id" => 0,
                "name" => 'não encontrado',
                "description" => '',
                "urls" => [],
                "thumbnail" => [
                    "path" => "http://i.annihil.us/u/prod/marvel/i/mg/b/40/image_not_available",
                    "extension" => "jpg"
                ]
            ]
        ];
    }
}
