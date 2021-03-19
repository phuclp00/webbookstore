<?php

namespace App\Exceptions;
use Throwable;
use Exception;
use Illuminate\Auth\AuthenticationException;
use App\Project\Frontend\Repo\Vehicle\EloquentVehicle;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Exceptions\InvalidOrderException;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class,
        InvalidOrderException::class,

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function report(Throwable $exception)
    {
        if ($exception instanceof CustomException) {
            return response()->view('errors.404', [], 500);

        }
    
        parent::report($exception);
    }
    public function register()
    {
        $this->renderable(function (InvalidOrderException $e, $request) {
            return response()->view('errors.404', [], 500);
        });
    }
    protected function showCustomErrorPage()
    {
        $recentlyAdded = app(EloquentVehicle::class)->fetchLatestVehicles(0, 12);

        return view()->make('errors.404')->with('recentlyAdded', $recentlyAdded);
    }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof CustomException) {
            return response()->view('errors.404', [], 500);
        }
    
        return parent::render($request, $exception);
    }
}
