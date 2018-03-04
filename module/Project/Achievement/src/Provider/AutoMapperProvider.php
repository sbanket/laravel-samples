<?php

namespace Project\Achievement\Provider;

use App\Providers\AutoMapperProvider as BaseAutoMapperProvider;
use Illuminate\Support\ServiceProvider;
use Project\Achievement\Mapper\AchievementDictionaryMapperFactory;

/**
 * Class AutoMapperProvider
 *
 * @package Project\Achievement\Provider
 */
class AutoMapperProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->tag(
            [
                AchievementDictionaryMapperFactory::class,
            ],
            BaseAutoMapperProvider::FACTORY_TAG
        );
    }
}
