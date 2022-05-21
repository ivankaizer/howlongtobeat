<?php

namespace IvanKayzer\HowLongToBeat;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class HttpClientCreator
{
    public static function create()
    {
        return new Client(HttpClient::create(['headers' => ['Referer' => 'https://howlongtobeat.com/']]));
    }
}
