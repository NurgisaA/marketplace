<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     *
     * Success response
     *
     * @param string $message
     * @param array $data
     * @param $status
     * @return JsonResponse
     */
    public function successResponse(string $message = "success", array $data = [], $status = 200): JsonResponse
    {
        return response()->json([
            "status" => true,
            "message" => $message,
            "data" => $data
        ], $status);
    }


    /**
     *
     * Error response
     *
     * @param string $message
     * @param array $data
     * @param $status
     * @return JsonResponse
     */
    public function errorResponse(string $message = "error", array $data = [], $status = 406): JsonResponse
    {
        return response()->json([
            "status" => false,
            "message" => $message,
            "data" => $data
        ], $status);
    }
}
