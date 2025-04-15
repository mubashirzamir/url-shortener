<?php

namespace App\Services;

use App\Contracts\CryptoService;
use App\Contracts\UrlStorage;
use App\Storage\InMemoryStorage;

class DefaultCryptoService implements CryptoService
{
    protected string $urlPrefix;
    /**
     * The following implementation is currently bound as the UrlStorage.
     * @var InMemoryStorage
     */
    protected UrlStorage $storage;

    public function __construct(UrlStorage $storage)
    {
        $this->urlPrefix = config('shortener.domain_name');
        $this->storage = $storage;
    }

    public function encode(string $url): string
    {
        $key = $this->generateKey($url);
        $this->storage->store($key, $url);

        return $this->urlPrefix . '/' . $key;
    }

    public function decode(string $url): ?string
    {
        return $this->storage->retrieve($this->getKeyFromUrl($url));
    }

    protected function generateKey(string $url): string
    {
        return substr(md5($url), 0, 6);
    }

    protected function getKeyFromUrl(string $url): string
    {
        $path = parse_url($url, PHP_URL_PATH);
        return ltrim($path, '/');
    }
}
