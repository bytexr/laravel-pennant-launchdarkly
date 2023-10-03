<?php

namespace ByteXR\LaravelPennantLaunchDarkly\Drivers;

use ByteXR\LaravelPennantLaunchDarkly\Concerns\HasLaunchDarklyContext;
use ByteXR\LaravelPennantLaunchDarkly\Exceptions\ScopeDoesNotHaveInterfaceException;
use ByteXR\LaravelPennantLaunchDarkly\Exceptions\UpdateLaunchDarklyFlagException;
use Illuminate\Support\Collection;
use Laravel\Pennant\Contracts\Driver;
use LaunchDarkly\LDClient;
use LaunchDarkly\LDContext;

class LaunchDarklyFeatureDriver implements Driver
{
    private LDClient $client;

    public function __construct()
    {
        $this->client = new LDClient(config('services.launch-darkly.key'), config('services.launch-darkly.options'));
    }

    public function define(string $feature, callable $resolver): void
    {
        throw new UpdateLaunchDarklyFlagException();
    }

    public function defined(): array
    {
        $context = LDContext::builder('laravel-pennant')->build();

        return array_keys($this->client->allFlagsState($context)->toValuesMap());
    }

    public function getAll(array $features): array
    {
        return Collection::make($features)
            ->map(fn ($scopes, $feature) => Collection::make($scopes)
                ->map(fn ($scope) => $this->get($feature, $scope))
                ->all())
            ->all();
    }

    public function get(string $feature, mixed $scope): mixed
    {
        if(!empty($scope)) {
            if (!$scope instanceof HasLaunchDarklyContext) {
                throw new ScopeDoesNotHaveInterfaceException('Scope [' . get_class($scope) . '] does not implement HasLaunchDarklyContext interface.');
            }

            $context = $scope->getLaunchDarklyContext();
        } else {
            $context = LDContext::builder('user')->build();
        }

        return $this->client->variation($feature, $context);
    }

    public function set(string $feature, mixed $scope, mixed $value): void
    {
        throw new UpdateLaunchDarklyFlagException();
    }

    public function setForAllScopes(string $feature, mixed $value): void
    {
        throw new UpdateLaunchDarklyFlagException();
    }

    public function delete(string $feature, mixed $scope): void
    {
        throw new UpdateLaunchDarklyFlagException();
    }

    public function purge(?array $features): void
    {
        throw new UpdateLaunchDarklyFlagException();
    }
}
