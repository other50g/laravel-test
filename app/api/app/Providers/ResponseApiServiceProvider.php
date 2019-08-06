<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

/**
 * レスポンス（API）
 * @package App\Providers
 */
class ResponseApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 成功時（200）
        Response::macro('success', function($message, $data = []) {
            return response()->json([
                'message' => $message,
                'data' => $data,
                'status' => 'success'
            ], 200);
        });

        // 失敗時（4xx, 5xx）
        Response::macro('error', function($message, array $errors = [], array $trace = [], $status = 500) {
            return response()->json([
                'message' => $message,
                'data' => [],
                'errors' => $errors,
                'trace' => $trace,
                'status' => 'error',
            ], $status);
        });
    }
}
