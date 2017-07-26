<?php

namespace Inviqa\JumpCloud\Api\Console\Resource;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Uri;

abstract class AbstractResource implements Resource
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

    protected function formatUri($options, $id = null)
    {
        $uri = new Uri($this->endpoint . ($id ? '/' . $id : ''));
        foreach (['limit', 'skip', 'sort', 'fields'] as $key) {
            if (array_key_exists($key, $options)) {
                $uri = Uri::withQueryValue($uri, $key, $options[$key]);
            }
        }
        return $uri;
    }

    public function fetch($options = [])
    {
        $autoPaginate = false;
        if (!array_key_exists('limit', $options)) {
            $options['skip'] = 0;
            $options['limit'] = 10;
            $autoPaginate = true;
        }
        $results = ['results' => [], 'totalCount' => 0];
        do {
            $response = $this->client->get($this->formatUri($options));
            $result = json_decode($response->getBody()->getContents(), true);
            $results['results'] = array_merge($results['results'], $result['results']);
            $results['totalCount'] = $result['totalCount'];

            if ($autoPaginate) {
                $options['skip'] += $options['limit'];
            }
        } while ($autoPaginate && ($options['skip'] + 1) < $result['totalCount']);
        return $results;
    }

    public function get($id, $options = [])
    {
        $response = $this->client->get($this->formatUri($options, $id));
        return json_decode($response->getBody()->getContents(), true);
    }

    public function post($data)
    {
        $response = $this->client->post(
            $this->formatUri(),
            [
                'json' => $data
            ]
        );
        return json_decode($response->getBody()->getContents(), true);
    }

    public function put($id, $data)
    {
        $response = $this->client->put(
            $this->formatUri([], $id),
            [
                'json' => $data
            ]
        );
        return json_decode($response->getBody()->getContents(), true);
    }

    public function delete($id)
    {
        $response = $this->client->delete($this->formatUri([], $id));
        return json_decode($response->getBody()->getContents(), true);
    }
}
