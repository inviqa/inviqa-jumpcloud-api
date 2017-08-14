<?php

namespace Inviqa\JumpCloud\Api\Console\Resource\V1;

use Inviqa\JumpCloud\Api\Console\AbstractBinding;

class SystemUserSudoers extends AbstractBinding
{
    /**
     * @var string
     */
    protected $endpoint = 'systemusers/%s/systems/sudoers';
}
