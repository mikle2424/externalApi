<?php

declare(strict_types=1);

namespace src\Http\Code;

class Successful implements Code
{
    public function value(): int
    {
        return 200;
    }
}