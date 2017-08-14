<?php

namespace Inviqa\JumpCloud\Api\Console;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Uri;

abstract class AbstractBinding
{
    /**
     * @var string
     */
    protected $endpoint = null;

    /**
     * @var GuzzleClient
     */
    protected $client;

    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    public function getName()
    {
        return $this->endpoint;
    }

    protected function formatUri($resource_id, $options = [])
    {
        $uri = new Uri(sprintf($this->endpoint, $resource_id));
        foreach (['limit', 'skip', 'sort', 'fields'] as $key) {
            if (array_key_exists($key, $options)) {
                $uri = Uri::withQueryValue($uri, $key, $options[$key]);
            }
        }
        return $uri;
    }

    public function fetch($resource_id, $options = [])
    {
        $response = $this->client->get($this->formatUri($resource_id, $options));
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function put($resource_id, $data)
    {
        $response = $this->client->put(
            $this->formatUri($resource_id),
            [
                'json' => $data
            ]
        );
        return json_decode($response->getBody()->getContents(), true);
    }
}
