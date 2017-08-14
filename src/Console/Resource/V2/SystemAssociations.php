<?php

namespace Inviqa\JumpCloud\Api\Console\Resource\V2;

use Inviqa\JumpCloud\Api\Console\AbstractAssociations;

class SystemAssociations extends AbstractAssociations
{
    /**
     * @var string
     */
    protected $endpoint = 'v2/systems/%s/associations';
}

