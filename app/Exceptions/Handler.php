<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
   /* public function handleApiException($request,$exception){
        if($exception instanceof ModelNotFoundException)
        {
            return response()->json(['error'='Model not Fount'],404);

        }
        
    }*/
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) 
            {
                return response()->json([
                    'message' => 'Record not found.'
                ], 404);
            }
        });
    }
    
   /* */
  /* public function render($request, Exception $exception)
    {   
        if($request->expectsJson()){
            dd(null);
        }
        return parent::render($request, $exception);
    } */
   /* public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }*/
}
