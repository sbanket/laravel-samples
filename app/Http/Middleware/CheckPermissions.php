<?php

namespace App\Http\Middleware;

use App\Service\RoutePermissionCheck;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Project\Employee\Service\CurrentEmployeeTrait;

/**
 * Class CheckPermissions
 *
 * @package App\Http\Middleware
 */
class CheckPermissions
{
    use CurrentEmployeeTrait;

    /**
     * @var RoutePermissionCheck
     */
    protected $permissionService;

    /**
     * CheckPermissions constructor.
     *
     * @param RoutePermissionCheck $permissionService
     */
    public function __construct(RoutePermissionCheck $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * @param Request      $request
     * @param Closure      $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest() || $this->permissionService->isGranted($this->getCurrentEmployee(), $request->route())) {
            return $next($request);
        }

        return abort(403, 'Access denied');
    }
}
