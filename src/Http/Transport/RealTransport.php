<?php

declare(strict_types=1);

namespace src\Http\Transport;

use src\Http\Code\Successful;
use src\Http\Response\DefaultResponse;
use src\Http\Response\Response;

class RealTransport implements HttpTransport
{
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function response(array $request): Response
    {
        // todo with real transport
        return new DefaultResponse(new Successful(), '');
    }
}