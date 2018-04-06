<?php
namespace Inviqa\JumpCloud\Api\Console;

interface ReadableResource
{
    public function getIdField(): string;
    public function getName(): string;
    public function fetch(array $options = []): ResourceList;
    public function get(string $id, array $options = []);
}
