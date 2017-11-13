<?php

namespace Inviqa\JumpCloud\Api\Console;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Uri;

abstract class AbstractAssociations implements Associations
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

    protected function formatUri($resource_id, $options)
    {
        $uri = new Uri(sprintf($this->endpoint, $resource_id));
        foreach (['targets', 'limit', 'skip', 'sort', 'fields'] as $key) {
            if (array_key_exists($key, $options)) {
                $uri = Uri::withQueryValue($uri, $key, $options[$key]);
            }
        }
        return $uri;
    }

    public function fetch($resource_id, $targets, $options = [])
    {
        $autoPaginate = false;
        $options['targets'] = $targets;
        if (!array_key_exists('limit', $options)) {
            $options['skip'] = 1;
            $options['limit'] = 10;
            $autoPaginate = true;
        }
        $results = ['results' => [], 'totalCount' => 0];
        do {
            $response = $this->client->get($this->formatUri($resource_id, $options));
            $result = json_decode($response->getBody()->getContents(), true);
            $results['results'] = array_merge($results['results'], $result);
            $results['totalCount'] = current($response->getHeader('X-Total-Count'));

            if ($autoPaginate) {
                $options['skip'] += $options['limit'];
            }
        } while ($autoPaginate && $options['skip'] < $results['totalCount']);
        return new ResourceList($results['results'], $results['totalCount']);
    }

    public function post($resource_id, $data)
    {
        $response = $this->client->post(
            $this->formatUri($resource_id),
            [
                'json' => $data
            ]
        );
        return json_decode($response->getBody()->getContents(), true);
    }

    private function postOp(int $resource_id, string $op, string $type, int $id, array $attributes = null): void
    {
        $data = [
            'attributes' => $attributes,
            'op' => $op,
            'type' => $type,
            'id' => $id,
        ];
        $this->post($resource_id, $data);
    }

    public function add($resource_id, $type, $id, $attributes = null): void
    {
        $this->postOp($resource_id, 'add', $type, $id, $attributes);
    }

    public function remove($resource_id, $type, $id, $attributes = null): void
    {
        $this->postOp($resource_id, 'remove', $type, $id, $attributes);
    }

    public function update($resource_id, $type, $id, $attributes = null): void
    {
        $this->postOp($resource_id, 'update', $type, $id, $attributes);
    }
}
