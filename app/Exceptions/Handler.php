<?php

namespace App\Exceptions;

use App\Enums\ResponseMethodEnum;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

use function PHPSTORM_META\type;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, \Throwable $exception) {
        if ($exception instanceof UnauthorizedHttpException || $exception instanceof AuthenticationException) {

            return generalApiResponse(ResponseMethodEnum::CUSTOM, customMessage: 'غير مصرح لك بالدخول', customStatusMsg: 'fail', customStatus: 401);
        }

        if ($exception instanceof ModelNotFoundException) {
            return generalApiResponse(ResponseMethodEnum::CUSTOM, customMessage: 'الصفحة غير موجودة', customStatusMsg: 'fail', customStatus: 404);
        }


        return parent::render($request, $exception);
    }
}
