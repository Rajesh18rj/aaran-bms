<?php

namespace Aaran\Auth\Identity\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ApiException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => $this->getMessage(),
            'code' => $this->getCode()
        ], $this->getCode() ?: 400);
    }
}

