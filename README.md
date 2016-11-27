# Laravel Historiae
<a href="https://packagist.org/packages/lais/historiae"><img src="https://poser.pugx.org/lais/historiae/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/lais/historiae"><img src="https://poser.pugx.org/lais/historiae/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/lais/historiae"><img src="https://poser.pugx.org/lais/historiae/license.svg" alt="License"></a>

## Introduction

Historiae provides history logging support to [Laravel](https://laravel.com/).

## License

Historiae is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Installation

To get started, install Historiae via the Composer package manager:

    composer require lais/historiae

### Configuration

After installing the library, register the `Historiae\HistoriaeServiceProvider` in your `config/app.php` configuration file:

```php
'providers' => [
    // Other service providers...

    Historiae\HistoriaeServiceProvider::class,
],
```

The Historiae service provider registers its own database migration directory with the framework, so you should migrate your database after registering the provider. The Historiae migrations will create the tables your application needs to store access logs and change logs:

    php artisan migrate

Next, you should run the `vendor:publish` command. This command will publish Historiae views, translations and configuration files, so you'll be able to customize your application as you see fit.

    php artisan vendor:publish
