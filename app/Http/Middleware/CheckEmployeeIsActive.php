<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Project\Employee\Service\CurrentEmployeeTrait;

/**
 * Class CheckEmployeeIsActive
 *
 * @package App\Http\Middleware
 */
class CheckEmployeeIsActive
{
    use CurrentEmployeeTrait;

    /**
     * @var array
     */
    protected $except = [
        'login',
        'logout',
    ];

    /**
     * @param Request      $request
     * @param Closure      $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guest() && $this->getCurrentEmployee()->isDismissed() && !$this->isExceptRequest($request)) {

            return abort(403, 'Access denied');
        }
        return $next($request);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    protected function isExceptRequest($request)
    {
        foreach ($this->except as $except) {
            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
