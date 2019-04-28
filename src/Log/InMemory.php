<?php

declare(strict_types=1);

namespace src\Log;

use Psr\Log\LoggerInterface;

class InMemory implements LoggerInterface
{
    private $storage;

    public function __construct(array &$storage)
    {
        $this->storage = &$storage;
    }

    public function emergency($message, array $context = array())
    {
        $this->storage[] = $message;
    }

    public function alert($message, array $context = array())
    {
        $this->storage[] = $message;
    }

    public function critical($message, array $context = array())
    {
        $this->storage[] = $message;
    }

    public function error($message, array $context = array())
    {
        $this->storage[] = $message;
    }

    public function warning($message, array $context = array())
    {
        $this->storage[] = $message;
    }

    public function notice($message, array $context = array())
    {
        $this->storage[] = $message;
    }

    public function info($message, array $context = array())
    {
        $this->storage[] = $message;
    }

    public function debug($message, array $context = array())
    {
        $this->storage[] = $message;
    }

    public function log($level, $message, array $context = array())
    {
        $this->storage[] = $message;
    }
}