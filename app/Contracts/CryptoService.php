<?php

namespace App\Contracts;

interface CryptoService
{
    public function encode(string $url): string;

    public function decode(string $url): ?string;
}
