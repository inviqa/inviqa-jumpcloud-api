<?php

namespace Inviqa\JumpCloud\Api\Console\Resource\V2;

use Inviqa\JumpCloud\Api\Console\Resource\AbstractResource as BaseClass;
use Inviqa\JumpCloud\Api\Console\Resource\ResourceList;

abstract class AbstractResource extends BaseClass
{
    public function fetch(array $options = []): ResourceList
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
            $results['results'] = array_merge($results['results'], $result);
            $results['totalCount'] = current($response->getHeader('X-Total-Count'));

            if ($autoPaginate) {
                $options['skip'] += $options['limit'];
            }
        } while ($autoPaginate && ($options['skip'] + 1) < $results['totalCount']);
        return new ResourceList($results['results'], $results['totalCount']);
    }
}
