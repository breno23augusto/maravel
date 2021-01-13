<?php

namespace App\Services;

use App\Contracts\HttpClient;

class MarvelApi
{
    private $timestamp;
    private $publicKey;
    private $privateKey;
    private $baseURL;
    private $httpClient;

    const minOffset = 0;
    const maxOffset = 1000;


    /**
     * Create a new MarvelAPI instance.
     *
     * @return void
     */
    public function __construct(HttpClient $httpClient, $timestamp)
    {
        $this->httpClient = $httpClient;
        $this->timestamp = $timestamp;
        $this->publicKey = config('marvelAPI.public_key');
        $this->privateKey = config('marvelAPI.private_key');
        $this->baseURL = config('marvelAPI.url');
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

        return self::prepareResult($this->httpClient::get($url)->json());
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

        return self::prepareResult($this->httpClient::get($url)->json());
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
        if ($result['code'] !== 200 or count($result['data']['results']) == 0) {
            return self::getNotFoundHeroe();
        }           
        
        return $result['data']['results'];
    }

    private static function getNotFoundHeroe()
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
