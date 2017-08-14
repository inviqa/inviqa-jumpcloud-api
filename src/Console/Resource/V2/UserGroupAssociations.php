<?php

namespace Inviqa\JumpCloud\Api\Console\Resource\V2;

use Inviqa\JumpCloud\Api\Console\AbstractAssociations;

class UserGroupAssociations extends AbstractAssociations
{
    /**
     * @var string
     */
    protected $endpoint = 'v2/usergroups/%s/associations';
}
