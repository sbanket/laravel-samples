<?php

namespace Project\Achievement;

use App\Module\AbstractModule;
use App\Module\Feature\ConfigProviderInterface;
use App\Module\Feature\RoutesProviderInterface;
use App\Module\Feature\ViewsProviderInterface;
use Project\Achievement\Provider\AutoMapperProvider;

/**
 * Class Module
 *
 * @package Project\Achievement
 */
class Module
    extends AbstractModule
    implements ConfigProviderInterface,
               RoutesProviderInterface,
               ViewsProviderInterface
{
    const ALIAS = 'project.achievement';

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
    public function getConfigPath()
    {
        return __DIR__ . '/../config/config.php';
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

    public function boot()
    {
        parent::boot();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
