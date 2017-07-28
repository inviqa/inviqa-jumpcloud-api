<?php
namespace Inviqa\JumpCloud\Api\Console\Resource;

interface Resource
{
    public function getName(): string;
    public function fetch(array $options = []): ResourceList;
    public function get(string $id, array $options = []);
    public function post(array $data);
    public function put(string $id, array $data);
    public function delete(string $id);
}
