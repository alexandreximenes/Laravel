<?php

namespace App\Exceptions;

use App\Traits\ApiResponder;
use Exception;
use Http\Client\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponder;
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
        if ($exception instanceof ValidationException):
            return $this->convertValidationExceptionToResponse($exception, $request);
        endif;
        if ($exception instanceof ModelNotFoundException):
            $modelName = strtolower(class_basename($exception->getModel()));
            return $this->errorResponde( "Does not exists any {$modelName} with the specified identificator", 404);
        endif;

        if ($exception instanceof AuthenticationException):
            return $this->unauthenticated($request, $exception);
        endif;

        if ($exception instanceof AuthorizationException):
            return $this->errorResponde($exception->getMessage(), 403);
        endif;

        if ($exception instanceof NotFoundHttpException):
            return $this->errorResponde("The specified URL connot be found", 404);
        endif;

        if ($exception instanceof MethodNotAllowedHttpException):
            return $this->errorResponde("The specified method for request is invalid", 405);
        endif;

        if ($exception instanceof HttpException):
            return $this->errorResponde($exception->getMessage(), $exception->getCode());
        endif;

        if ($exception instanceof QueryException):

            $errorCode = $exception->errorInfo[1];
            if($errorCode == 1451):
                $this->errorResponde("Cannot remove this resource permanently. It is related with any other resource", 409);
            endif;
        endif;

        if(config('app.debug')):
            return parent::render($request, $exception);    
        endif;

        return errorResponse("Unexpected error internal server",500);
        
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();
        return $this->errorResponde( $errors, 422);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponde("Unauthenticated", 401);
    }
}
