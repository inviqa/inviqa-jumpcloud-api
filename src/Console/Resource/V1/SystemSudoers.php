<?php

namespace Inviqa\JumpCloud\Api\Console\Resource\V1;

use Inviqa\JumpCloud\Api\Console\AbstractBinding;

class SystemSudoers extends AbstractBinding
{
    /**
     * @var string
     */
    protected $endpoint = 'systems/%s/systemusers/sudoers';
}
