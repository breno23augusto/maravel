<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Contracts\HttpClient;

class HttpLaravel extends Http implements HttpClient
{
    static function getFacadeAccessor()
    {
        return Http::getFacadeAccessor();
    }
}
