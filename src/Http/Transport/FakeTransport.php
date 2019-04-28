<?php

declare(strict_types=1);

namespace src\Http\Transport;

use src\Http\Code\Successful;
use src\Http\Response\DefaultResponse;
use src\Http\Response\Response;

class FakeTransport implements HttpTransport
{
    public function response(array $request): Response
    {
        return new DefaultResponse(new Successful(), "default response data");
    }
}