<?php

declare(strict_types=1);

namespace src\Http\Code;

class Failed implements Code
{
    public function value(): int
    {
        return 500;
    }
}