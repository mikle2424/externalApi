<?php

declare(strict_types=1);

namespace src\Integration;

use src\Http\Code\Successful;
use src\Http\Response\DefaultResponse;
use src\Http\Response\Response;

class FakeApi implements API
{
    private $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function get(array $request): Response
    {
        return new DefaultResponse(new Successful(), $this->data);
    }

}