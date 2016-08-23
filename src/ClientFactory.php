<?php

namespace Inviqa\JumpCloud\Api;

use GuzzleHttp\Client as GuzzleClient;

class ClientFactory
{
    static function getClient($apiKey, $endpoint)
    {
        return new GuzzleClient([
            'base_uri' => $endpoint,
            'headers' => [
                'x-api-key' => $apiKey
            ]
        ]);
    }
}
