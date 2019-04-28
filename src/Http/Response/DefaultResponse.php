<?php

declare(strict_types=1);

namespace src\Http\Response;

use src\Http\Code\Code;

class DefaultResponse implements Response
{
    private $data;
    private $code;

    public function __construct(Code $code, string $data)
    {
        $this->code = $code;
        $this->data = $data;
    }

    public function body(): string
    {
        return $this->data;
    }

    public function code(): Code
    {
        return $this->code;
    }
}