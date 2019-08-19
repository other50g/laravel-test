<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use App\Providers\ResponseApiServiceProvider;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $e = $this->prepareException($exception);

        if ($e instanceof HttpResponseException) {
            return $e->getResponse();
        } elseif ($e instanceof AuthenticationException) {
            $status = Response::HTTP_UNAUTHORIZED;
            $message = '認証に失敗しました。ログインしてください。';
            $errors = [];
            $trace = [];
        } elseif ($e instanceof ValidationException) {
            $status = $e->status;
            $message = Response::$statusTexts[$status];
            $errors = $e->errors();
            $trace = [];
        } elseif ($this->isHttpException($e)) {
            $status = $e->getCode();
            if ($status == 0) {
                $status = 400;
            }
            $message = $e->getMessage();
            $errors = [];
            $trace = [];
        } else {
            $code = env('APP_DEBUG', true) ? $e->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
            if (isset($code)) {
                $code = Response::HTTP_INTERNAL_SERVER_ERROR;
            }
            $status = $code;
            $message = env('APP_DEBUG', true) ? $e->getMessage() : 'サーバエラーが発生しました。管理者に連絡してください。';
            $errors = [];
            $trace = env('APP_DEBUG', true) ? $e->getTrace() : [];
        }

        // ResponseApiServiceProviderが実行される前にエラーが発生した場合の対応
        if (!method_exists(response(), 'error')) {
            $app = app();
            $provide = new ResponseApiServiceProvider($app);
            $provide->boot();
        }

        return response()->error($message, $errors, $trace, $status);
    }
}
