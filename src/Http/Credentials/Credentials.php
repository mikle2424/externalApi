<?php

namespace src\Http\Credentials;

interface Credentials
{
    public function user(): string;

    public function password(): string;
}