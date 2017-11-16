<?php
namespace Inviqa\JumpCloud\Api\Console;

interface Resource extends ReadableResource
{
    public function post(array $data);
    public function put(string $id, array $data);
    public function delete(string $id);
}
