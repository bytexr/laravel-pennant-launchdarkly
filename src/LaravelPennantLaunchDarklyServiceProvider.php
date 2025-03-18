<?php

namespace ByteXR\LaravelPennantLaunchDarkly;

use ByteXR\LaravelPennantLaunchDarkly\Drivers\LaunchDarklyFeatureDriver;
use Laravel\Pennant\Feature;

class LaravelPennantLaunchDarklyServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(): void
    {
        Feature::extend('launch-darkly', function () {
            return new LaunchDarklyFeatureDriver();
        });

        $configPath = __DIR__ . '/../config/pennant-launchdarkly.php';

        $this->publishes([
            $configPath => config_path('pennant-launchdarkly.php'),
        ]);
        $this->mergeConfigFrom($configPath, 'pennant-launchdarkly');
    }
}
