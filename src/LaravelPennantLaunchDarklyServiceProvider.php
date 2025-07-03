<?php

namespace ByteXR\LaravelPennantLaunchDarkly;

use ByteXR\LaravelPennantLaunchDarkly\Drivers\LaunchDarklyFeatureDriver;
use Illuminate\Contracts\Foundation\Application;
use Laravel\Pennant\Feature;
use LaunchDarkly\Integrations\DynamoDb;
use LaunchDarkly\LDClient;

class LaravelPennantLaunchDarklyServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LDClient::class, function () {
            $fr = DynamoDB::featureRequester([
                "dynamodb_table" => config('services.launch-darkly.dynamodb.table')
            ]);
            $config = [
                ...config('services.launch-darkly.options'),
                "feature_requester" => $fr
            ];
            return new LDClient(config('services.launch-darkly.key'),$config);
        });
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
