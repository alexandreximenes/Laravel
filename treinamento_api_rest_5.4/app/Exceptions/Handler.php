<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{

    use ApiResponse;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
        print_r($request);

        if($exception instanceof ValidationException):
            return $this->convertValidationExceptionToResponse($exception, $request);
        endif;

        if($exception instanceof ModelNotFoundException):
            $modelName = strtolower(class_basename($exception->getModel()));

            return $this->errorResponse("Does not exists any {$modelName} with the specified identificator", 404);
        endif;

        if($exception instanceof AuthenticationException):
            return $this->unauthenticated($request, $exception);
        endif;

        if($exception instanceof AuthorizationException):
            return $this->errorResponse($exception->getMessage(), 403);
        endif;

         if($exception instanceof NotFoundHttpException):
            return $this->errorResponse('The specified URL cannot be found', 404);
        endif;

        if($exception instanceof MethodNotAllowedHttpException):
            return $this->errorResponse('The specified method for the request is invalid', 405);
        endif;

        if($exception instanceof HttpException):
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        endif;

        if($exception instanceof QueryException):
            $erroCode = $exception->errorInfo[1];
            if($erroCode == 1451):
                return $this->errorResponse('Cannot remove this resource permanently. It is related with any toher resource' , 409);
            endif;
        endif;

        if(config('app.debug')){
            return parent::render($request, $exception);
        }

        return $this->errorResponse('Unexpected Exception. try later', 500);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponse( 'Unauthenticated.', 401);

        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();

        return $this->errorResponse($errors, 422);

    }
}
