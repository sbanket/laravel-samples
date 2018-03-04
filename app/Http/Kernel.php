<?php

namespace App\Http;

use App\Http\Middleware\CheckEmployeeIsActive;
use App\Http\Middleware\CheckFeatures;
use App\Http\Middleware\CheckPermissions;
use App\Http\Middleware\CheckProfileCompletion;
use App\Http\Middleware\GenerateMenus;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware
        = [
            CheckForMaintenanceMode::class,
            ValidatePostSize::class,
            Middleware\TrimStrings::class,
            ConvertEmptyStringsToNull::class,
            Middleware\TrustProxies::class,
        ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups
        = [
            'web' => [
                Middleware\EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                CheckEmployeeIsActive::class,
                GenerateMenus::class,
                CheckPermissions::class,
                CheckProfileCompletion::class,
                CheckFeatures::class,
                ShareErrorsFromSession::class,
                Middleware\VerifyCsrfToken::class,
                SubstituteBindings::class,
            ],

            'api' => [
                'throttle:60,1',
                'bindings',
            ],
        ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware
        = [
            'auth'       => Authenticate::class,
            'auth.basic' => AuthenticateWithBasicAuth::class,
            'bindings'   => SubstituteBindings::class,
            'can'        => Authorize::class,
            'guest'      => Middleware\RedirectIfAuthenticated::class,
            'throttle'   => ThrottleRequests::class,
        ];
}
