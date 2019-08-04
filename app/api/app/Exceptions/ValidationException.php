<?php

namespace App\Exceptions;

use Exceptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ValidationException extends Exceptions
{
    public $request;
    public $message;

    public function __construct(Request $request, array $message)
    {
        $this->request = $request;
        $this->message = $message;
    }

    public function report()
    {
        $xRequestId = array_key_exists('x-request-id', $this->request->header()) ? $this->request->header()['x-request-id'][0] : '';
        Log::info(
            $xRequestId,
            [
                'client_ip' => $this->request->getClientIp(),
                'request_params' => $this->request->all(),
                'response_body' => $this->message,
            ]
        );
    }

    public function render()
    {
        return response()->json(
            $this->message,
            422
        );
    }
}
