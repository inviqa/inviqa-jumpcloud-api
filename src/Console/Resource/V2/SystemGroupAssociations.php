<?php

namespace Inviqa\JumpCloud\Api\Console\Resource\V2;

use Inviqa\JumpCloud\Api\Console\AbstractAssociations;

class SystemGroupAssociations extends AbstractAssociations
{
    /**
     * @var string
     */
    protected $endpoint = 'v2/systemgroups/%s/associations';
}
