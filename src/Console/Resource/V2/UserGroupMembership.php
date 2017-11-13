<?php

namespace Inviqa\JumpCloud\Api\Console\Resource\V2;

use Inviqa\JumpCloud\Api\Console\AbstractBindingV2;

class UserGroupMembership extends AbstractBindingV2
{
    /**
     * @var string
     */
    protected $endpoint = 'v2/usergroups/%s/membership';
}
