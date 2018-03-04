<?php

namespace Axmit\Notification;

use App\Module\AbstractModule;
use App\Module\Feature\RoutesProviderInterface;
use App\Module\Feature\ViewsProviderInterface;
use Axmit\Notification\Providers\AutoMapperProvider;

/**
 * Class Module
 *
 * @package Axmit\Notification
 */
class Module extends AbstractModule implements RoutesProviderInterface, ViewsProviderInterface
{

    const ALIAS = 'notification';

    /**
     * @return string
     */
    public function getAlias()
    {
        return static::ALIAS;
    }

    /**
     * @return string
     */
    public function getRoutesPath()
    {
        return __DIR__ . '/../routes/web.php';
    }

    /**
     * @return string
     */
    public function getViewsPath()
    {
        return __DIR__ . '/../resources/views';
    }

    public function register()
    {
        parent::register();
        $this->app->register(AutoMapperProvider::class);
    }
}
