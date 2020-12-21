<?php

namespace Fecony\YandexSpeller\Http;

use GuzzleHttp\Client;

class HttpClient
{
    /** @var string API JSON interface */
    protected const API_URL = 'https://speller.yandex.net/services/spellservice.json/';

    /** @var string API endpoint to check single string */
    protected const CHECK_TEXT_ENDPOINT = 'checkText';

    /** @var string API endpoint to check array of strings */
    protected const CHECK_TEXTS_ENDPOINT = 'checkTexts';

    /**
     * @var Client
     */
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::API_URL,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
        ]);
    }
}
