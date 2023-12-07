# Laravel Pennant LaunchDarkly

<p align="center">
<a href="https://packagist.org/packages/bytexr/laravel-pennant-launchdarkly"><img src="https://img.shields.io/packagist/dt/bytexr/laravel-pennant-launchdarkly" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/bytexr/laravel-pennant-launchdarkly"><img src="https://img.shields.io/packagist/v/bytexr/laravel-pennant-launchdarkly" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/bytexr/laravel-pennant-launchdarkly"><img src="https://img.shields.io/packagist/l/bytexr/laravel-pennant-launchdarkly" alt="License"></a>
</p>

## Introduction

Laravel Pennant LaunchDarkly simplifies the integration of Laravel Pennant with LaunchDarkly, offering a seamless experience.

## Installation

```shell
composer require bytexr/laravel-pennant-launchdarkly
```

To make the necessary updates, navigate to `config/services.php` and add the following code:

```php
return [
    ...

    'launch-darkly' => [
        'key'     => env('LAUNCH_DARKLY_KEY'),
        'options' => [],
    ]

];

```

If already haven't, publish Laravel Pennant config and add store to the config file in `config/pennant.php`:

```php

    'stores' => [
        ...

        'launch-darkly' => [
            'driver' => 'launch-darkly'
        ]

    ]
```


Ensure that all required environment variables are set in your `.env` file, and don't forget to set the `PENNANT_STORE` value to `launch-darkly`.

Extends `User` model and all other scopes used in Pennant with `HasLaunchDarklyContext` interface and implement methods:

```php
class User extends Authenticatable implements HasLaunchDarklyContext
{
    ...
    
    public function getLaunchDarklyContext(): LDContext|LDUser
    {
        return (new LDUserBuilder($this->getKey()))
            ->email($this->email)
            ->build();
    }
    
    // OR if you would like to use context instead

    public function getLaunchDarklyContext(): LDContext|LDUser
    {
        return LDContext::builder('user')
                        ->set('email', $this->email)
                        ->build();
    }
}
```

## License

Laravel Pennant LaunchDarkly is open-sourced software licensed under the [MIT license](LICENSE).
