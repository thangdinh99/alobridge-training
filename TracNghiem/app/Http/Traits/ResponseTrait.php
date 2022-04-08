<?php

namespace App\Http\Traits;


trait ResponseTrait
{
    public function responseError($statusCode, $message, $error)
    {
        return response()->json([
            'status_code' => $statusCode,
            'message' => $message,
            'error' => $error,
        ]);
    }

    public function responseData($statusCode, $message, $data)
    {
        return response()->json([
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ]);
    }
    
    public function responseMessage($statusCode, $message)
    {
        return response()->json([
            'status_code' => $statusCode,
            'message' => $message,
        ]);
    }
}
