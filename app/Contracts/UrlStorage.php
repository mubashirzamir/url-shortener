<?php

namespace App\Contracts;

interface UrlStorage
{
    public function store(string $key, string $url): bool;
    public function retrieve(string $key): ?string;
}
