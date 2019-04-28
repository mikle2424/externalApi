<?php

declare(strict_types=1);

namespace src\Http\Response;

use src\Http\Code\Code;

interface Response
{
    public function body(): string;

    public function code(): Code;
}