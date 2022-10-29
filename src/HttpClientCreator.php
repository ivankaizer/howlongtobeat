<?php

namespace IvanKayzer\HowLongToBeat;

use GuzzleHttp\Client;

class HttpClientCreator
{
    public static function create(): Client
    {
        return new Client([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Linux; Android 11; Pixel 5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.91 Mobile Safari/537.36',
                'referer' => 'https://howlongtobeat.com/'
            ]
        ]);
    }
}
