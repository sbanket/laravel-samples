<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Project\Employee\Service\CurrentEmployeeTrait;

/**
 * Class CheckProfileCompletion
 *
 * @package App\Http\Middleware
 */
class CheckProfileCompletion
{
    use CurrentEmployeeTrait;

    const REDIRECT_ROUTE = 'employee.incomplete';

    protected $ignoreRoutes = [
        self::REDIRECT_ROUTE,
        'logout',
    ];

    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guest()
            && !$this->getCurrentUser()->getOriginal()->isAdmin()
            && !$this->getCurrentEmployee()->isProfileCompleted()
            && !$request->routeIs($this->ignoreRoutes)
        ) {
            return redirect(route(self::REDIRECT_ROUTE));
        }

        return $next($request);
    }
}
