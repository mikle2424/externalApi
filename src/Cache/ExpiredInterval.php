<?php

declare(strict_types=1);

namespace src\Cache;

class ExpiredInterval
{
    public function value(): string
    {
        return '+1 day';
    }
}