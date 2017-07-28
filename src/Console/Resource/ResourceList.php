<?php

namespace Inviqa\JumpCloud\Api\Console\Resource;

use ArrayObject;

class ResourceList extends ArrayObject
{
    public function __construct(array $data, int $totalCount)
    {
        parent::__construct($data);
        $this->totalCount = $totalCount;
    }

    public function getTotalCount()
    {
        return $this->totalCount;
    }
}
