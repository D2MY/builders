<?php

namespace D2my\Builders;

use Illuminate\Support\ServiceProvider;

class ExtendedBuildersServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/builders.php' => config_path('builders.php'),
            ], 'builders');
        }
    }
}
