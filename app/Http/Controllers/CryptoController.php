<?php

namespace App\Http\Controllers;

use App\Contracts\CryptoService;
use App\Http\Requests\CryptoRequest;
use App\Services\DefaultCryptoService;
use Illuminate\Http\JsonResponse;

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

    public function encode(CryptoRequest $request): JsonResponse
    {
        return response()->json(['url' => $this->cryptoService->encode($request->input('url'))]);
    }

    public function decode(CryptoRequest $request): JsonResponse
    {
        $decode = $this->cryptoService->decode($request->input('url'));

        if ($decode === null) {
            return response()->json(['error' => 'URL not found'], 404);
        }

        return response()->json(['url' => $decode]);
    }
}
