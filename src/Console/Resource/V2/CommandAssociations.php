<?php

namespace Inviqa\JumpCloud\Api\Console\Resource\V2;

use Inviqa\JumpCloud\Api\Console\Resource\AbstractAssociations;

class CommandAssociations extends AbstractAssociations
{
    /**
     * @var string
     */
    protected $endpoint = 'v2/commands/%s/associations';
}
