<?php
namespace Inviqa\JumpCloud\Api\Console\Resource;

interface Resource
{
    public function getName();
    public function fetch($options = []);
    public function get($id, $options = []);
    public function post($data);
    public function put($id, $data);
    public function delete($id);
}
