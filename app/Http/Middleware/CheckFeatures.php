<?php

namespace App\Http\Middleware;

use App\Service\RouteFeatureCheck;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CheckFeatureRoute
 *
 * @package App\Http\Middleware
 */
class CheckFeatures
{
    /**
     * @var RouteFeatureCheck
     */
    protected $featureService;

    /**
     * CheckFeatures constructor.
     *
     * @param RouteFeatureCheck $featureService
     */
    public function __construct(RouteFeatureCheck $featureService)
    {
        $this->featureService = $featureService;
    }

    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->featureService->checkActiveFeatureRoute($request->route())) {
            throw new NotFoundHttpException();
        }

        return $next($request);
    }
}
