<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jobs\SampleJob;

class SampleController extends Controller
{
    /**
     * キューの実行（サンプル）
     */
    public function execute()
    {
        dispatch(new SampleJob());

        return response()->success('キューを実行しました。', []);
    }
}
