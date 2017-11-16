<?php
namespace Inviqa\JumpCloud\Api\Console;

interface ReadableResource
{
    public function getName(): string;
    public function fetch(array $options = []): ResourceList;
    public function get(string $id, array $options = []);
}
