<?php

namespace App\Providers;

use App\Http\Resource\ResourcesMap;
use App\Service\RouteFeatureCheck;
use App\Service\RoutePermissionCheck;
use App\Validator\CurrentPasswordRule;
use App\Validator\UsernameUniqueRule;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('current_password', CurrentPasswordRule::class);
        Validator::extend('username_unique', UsernameUniqueRule::class);

        $this->app->when(RoutePermissionCheck::class)
                  ->needs('$rules')
                  ->give(config('permissions'));

        $this->app->when(ResourcesMap::class)
                  ->needs('$config')
                  ->give(config('http.resources.map'));

        $this->app->when(RouteFeatureCheck::class)
                  ->needs('$featureRoutes')
                  ->give(config('featureroutes'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        setlocale(LC_TIME, config('app.system_locale'));

        $this->app->register(AutoMapperProvider::class);
        $this->app->register(ModuleAliasServiceProvider::class);

        if ($this->app->environment() == 'local') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
