<?php

namespace App\Helpers\v1;

class ApiResponseV1
{
    public static function success($data, $statusCode = 200)
    {
        return response()->json($data, $statusCode);
    }

    public static function error($message, $statusCode = 400)
    {
        return response()->json(['error' => $message], $statusCode);
    }
}
