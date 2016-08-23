<?php
namespace Inviqa\JumpCloud\Api;

interface Operation
{
    public function getName();
    public function fetch($options = []);
    public function get($id, $options = []);
}
