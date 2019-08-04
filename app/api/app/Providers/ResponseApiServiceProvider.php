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
        Response::macro('success', function($data) {
            return response()->json([
                'data' => $data,
                'status' => 'success'
            ], 200);
        });
    }
}
