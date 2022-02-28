<?php

namespace App\Traits;
use Illuminate\Support\Facades\Http;

trait Data
{
    function get($url)
    {
        $response = Http::get($url);

        if ($response->successful()) {
            return $response->json();
        }
        return $response->getReasonPharse();
    }
}
