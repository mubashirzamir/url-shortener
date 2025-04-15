<?php

namespace App\Storage;

use App\Contracts\UrlStorage;
use Illuminate\Support\Facades\Cache;

class InMemoryStorage implements UrlStorage
{
    public function store(string $key, string $url): bool
    {
        return Cache::put($key, $url);
    }

    public function retrieve(string $key): ?string
    {
        return Cache::get($key);
    }
}
