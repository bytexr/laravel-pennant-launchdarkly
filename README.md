# Laravel Pennant LaunchDarkly

<p align="center">
<a href="https://packagist.org/packages/bytexr/laravel-scout-opensearch"><img src="https://img.shields.io/packagist/dt/bytexr/laravel-scout-opensearch" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/bytexr/laravel-scout-opensearch"><img src="https://img.shields.io/packagist/v/bytexr/laravel-scout-opensearch" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/bytexr/laravel-scout-opensearch"><img src="https://img.shields.io/packagist/l/bytexr/laravel-scout-opensearch" alt="License"></a>
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
        'key' => env('LAUNCH_DARKLY_KEY')
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


Finally, ensure that all required environment variables are set in your `.env` file, and don't forget to set the `PENNANT_STORE` value to `launch-darkly`.

## License

Laravel Pennant LaunchDarkly is open-sourced software licensed under the [MIT license](LICENSE).
