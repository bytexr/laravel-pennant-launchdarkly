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

        $this->publishes([
            __DIR__.'/../config/pennant-launchdarkly.php' => config_path('pennant-launchdarkly.php'),
        ]);
    }
}
