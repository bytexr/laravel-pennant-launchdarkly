<?php

namespace ByteXR\LaravelPennantLaunchDarkly;

use ByteXR\LaravelPennantLaunchDarkly\Drivers\LaunchDarklyFeatureDriver;
use Illuminate\Contracts\Foundation\Application;
use Laravel\Pennant\Feature;
use LaunchDarkly\LDClient;

class LaravelPennantLaunchDarklyServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LDClient::class, fn() => new LDClient(config('services.launch-darkly.key'), config('services.launch-darkly.options')));
    }

    public function boot(): void
    {
        Feature::extend('launch-darkly', function (Application $app) {
            return new LaunchDarklyFeatureDriver($app->make(LDClient::class));
        });

        $configPath = __DIR__ . '/../config/pennant-launchdarkly.php';

        $this->publishes([
            $configPath => config_path('pennant-launchdarkly.php'),
        ]);
        $this->mergeConfigFrom($configPath, 'pennant-launchdarkly');
    }
}
