<?php

namespace App\Http\Controllers;

use App\Contracts\CryptoService;
use App\Http\Requests\CryptoRequest;
use App\Services\DefaultCryptoService;

class CryptoController extends Controller
{
    /**
     * The following implementation is currently bound as the CryptoService.
     * @var DefaultCryptoService
     */
    protected CryptoService $cryptoService;

    public function __construct(CryptoService $cryptoService)
    {
        $this->cryptoService = $cryptoService;
    }

    public function encode(CryptoRequest $request): array
    {
        return ['url' => $this->cryptoService->encode($request->input('url'))];
    }

    public function decode(CryptoRequest $request): array
    {
        return ['url' => $this->cryptoService->decode($request->input('url'))];
    }
}
