<?php

declare(strict_types=1);

namespace src\Cache;

class Hashed
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function value(): string
    {
        return sha1(json_encode($this->data));
    }
}