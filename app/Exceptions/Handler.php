<?php
 
namespace App\Exceptions;

use App\Http\Traits\ApiResponser;
 use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    
    use ApiResponser;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        ValidationException::class,
    ];
 
    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Throwable $exception)
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
    public function render($request, Throwable $exception)
    {
        if($exception instanceof ValidationException){
            return $this->convertValidationExceptionToResponse($exception , $request);
        }

        if($exception instanceof ModelNotFoundException){
          $modelName = strtolower(class_basename($exception->getModel()));

            return $this->errorResponser("Does not exists any { $modelName } with the specified identificator", 404);
        }

        if($exception instanceof AuthenticationException){
            return $this->unauthenticated($request , $exception );
        }

        if($exception instanceof AuthorizationException){
            return $this->errorResponser($exception->getMessage() , 403);
        }

        if($exception instanceof NotFoundHttpException){
            return $this->errorResponser('The specified URL cannot be found', 404);
        }
        
        return parent::render($request, $exception);
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
         return $this->errorResponser('Unathenticated' , 401);
    }

 protected function convertValidationExceptionToResponse(ValidationValidationException $e, $request)
 {
     $errors = $e->validator->errors()->getMessages();
     return $this->errorResponser($errors , 422);
 }


 }

