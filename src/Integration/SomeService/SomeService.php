<?php

declare(strict_types=1);

namespace src\Integration\SomeService;

use src\Http\Credentials\Credentials;
use src\Http\Response\Response;
use src\Http\Transport\HttpTransport;
use src\Integration\API;

class SomeService implements API
{
    private $credentials;
    private $transport;

    public function __construct(Credentials $credentials, HttpTransport $transport)
    {
        $this->credentials = $credentials;
        $this->transport = $transport;
    }

    public function get(array $request): Response
    {
        return $this->withCredentials($request);
    }

    private function withCredentials(array $request)
    {
        // todo use $this->credentials into $request
        return $this->transport->response($request);
    }
}