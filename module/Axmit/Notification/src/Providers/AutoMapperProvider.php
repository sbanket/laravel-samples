<?php

namespace Axmit\Notification\Providers;

use Axmit\Notification\Mapper\NotificationMapperFactory;
use Illuminate\Support\ServiceProvider;
use App\Providers\AutoMapperProvider as BaseAutoMapperProvider;

/**
 * Class AutoMapperProvider
 *
 * @package Axmit\Notification\Providers
 */
class AutoMapperProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->tag(
            [
                NotificationMapperFactory::class,
            ],
            BaseAutoMapperProvider::FACTORY_TAG
        );
    }
}
