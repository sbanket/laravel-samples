<?php

namespace App\Service;

use Illuminate\Routing\Route;
use Lavary\Menu\Builder;
use Lavary\Menu\Item;
use Lavary\Menu\Menu;
use Project\Employee\Dto\EmployeeEntityTo;

/**
 * Class MenuBuilder
 *
 * @package App\Service
 */
class MenuBuilder
{
    /**
     * @var RoutePermissionCheck
     */
    protected $permissionService;

    /**
     * @var RouteFeatureCheck
     */
    protected $featureService;

    /**
     * MenuBuilder constructor.
     *
     * @param RoutePermissionCheck $permissionService
     * @param RouteFeatureCheck    $featureService
     */
    public function __construct(RoutePermissionCheck $permissionService, RouteFeatureCheck $featureService)
    {
        $this->permissionService = $permissionService;
        $this->featureService    = $featureService;
    }

    /**
     * @param string           $name
     * @param EmployeeEntityTo $employee
     *
     * @return Menu
     */
    public function build(string $name, EmployeeEntityTo $employee)
    {
        $config = $this->getConfig($name);
        $menu   = \Menu::make(
            $name,
            function (Builder $menu) use ($config) {
                if (!empty($config['items']) && is_array($config['items'])) {
                    $this->addItem($menu, $config['items']);
                }
            }
        )->filter(
            function (Item $item) use ($employee) {
                $route = \Route::getRoutes()->getByName($item->data('routename'));
                if (!$route instanceof Route) {
                    return true;
                }

                return $this->permissionService->isGranted($employee, $route);
            }
        )->filter(
            function (Item $item) {
                $route = \Route::getRoutes()->getByName($item->data('routename'));
                if (!$route instanceof Route) {
                    return true;
                }

                return $this->featureService->checkActiveFeatureRoute($route);
            }
        )->filter(
            function (Item $item) {
                if (!$item->data('has_children')) {
                    return true;
                }

                if (empty($item->data('routename')) && !$item->hasChildren()) {
                    return false;
                }

                return true;
            }
        );

        return $menu;
    }

    /**
     * @param mixed $menu
     * @param array $config
     */
    public function addItem($menu, array $config)
    {
        foreach ($config as $key => $item) {
            $options = !empty($item['attributes']) && is_array($item['attributes']) ? $item['attributes'] : [];
            if (!empty($item['route'])) {
                $options['route'] = $item['route'];
            }

            $menuItem = $menu->add($item['label'], $options);
            if (!empty($item['route'])) {
                $menuItem->data('routename', $item['route']);
            }

            if (!empty($item['items']) && is_array($item['items'])) {
                $menuItem->data('has_children', true);
                $this->addItem($menuItem, $item['items']);
            }
        }
    }

    /**
     * @param $key
     *
     * @return array
     */
    protected function getConfig($key): array
    {
        $config = config('menu');

        return empty($config[$key]) || !is_array($config[$key]) ? [] : $config[$key];
    }
}
