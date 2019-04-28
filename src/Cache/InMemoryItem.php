<?php

declare(strict_types=1);

namespace src\Cache;

use Psr\Cache\CacheItemInterface;

class InMemoryItem implements CacheItemInterface
{
    private $value;
    private $key;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function get()
    {
        return $this->value;
    }

    public function isHit()
    {
        return isset($this->value);
    }

    public function set($value)
    {
        $this->value = $value;
        return $this;
    }

    public function expiresAt($expiration)
    {
        return $this;
    }

    public function expiresAfter($time)
    {
        // TODO: Implement expiresAfter() method.
    }
}