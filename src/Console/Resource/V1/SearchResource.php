<?php

namespace Inviqa\JumpCloud\Api\Console\Resource\V1;

use Inviqa\JumpCloud\Api\Console\Resource\AbstractResource;

class SearchResource extends AbstractResource
{
    public function search($filter = [], $options = [])
    {
        $requestOptions = array_filter(
            $options,
            function ($key) {
                return in_array($key, ['limit', 'skip', 'sort', 'fields']);
            },
            ARRAY_FILTER_USE_KEY
        );
        $requestOptions['filter'] = $filter;

        $response = $this->client->post(
            'search/' . $this->endpoint, [
                'json' => $requestOptions
            ]
        );
        return json_decode($response->getBody()->getContents(), true);
    }
}
