<?php

namespace N2boost\LaravelDoctrineMapping;

use Illuminate\Support\ServiceProvider;

class LaravelDoctrineMappingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-doctrine-mapping.php' => config_path('laravel-doctrine-mapping.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\GenerateEntities::class,
                Commands\SchemeTool::class,
            ]);
        }
    }
}
