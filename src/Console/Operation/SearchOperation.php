<?php

namespace Inviqa\JumpCloud\Api\Console\Operation;

class SearchOperation extends AbstractOperation
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
