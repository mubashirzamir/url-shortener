<?php

namespace App\Http\Controllers;

use App\Http\Requests\CryptoRequest;

class CryptoController extends Controller
{
    public function encode(CryptoRequest $request)
    {
        return "encode";
    }

    public function decode(CryptoRequest $request)
    {
        return "decode";
    }
}
