# laravel-travelperk [![tag](https://img.shields.io/github/tag/namelivia/laravel-travelperk.svg)](https://github.com/namelivia/laravel-travelperk/releases) [![Build Status](https://travis-ci.org/namelivia/laravel-travelperk.svg?branch=master)](https://travis-ci.org/namelivia/laravel-travelperk) [![codecov](https://codecov.io/gh/namelivia/laravel-travelperk/branch/master/graph/badge.svg)](https://codecov.io/gh/namelivia/laravel-travelperk)

<p align="center">
  <img src="https://user-images.githubusercontent.com/1571416/89100898-508ea880-d3fb-11ea-8bc8-7f6a9e9b71c0.png" alt="Laravel TravelPerk" />
</p>

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require namelivia/laravel-travelperk
```

Add the service provider to `config/app.php` in the `providers` array. If you're using Laravel 5.5 or greater, there's no need to do this.

```php
Namelivia\TravelPerk\Laravel\TravelPerkServiceProvider::class
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in `config/app.php` to your aliases array.

```php
'TravelPerk' => Namelivia\TravelPerk\Laravel\Facades\TravelPerk::class
```

## Configuration

Laravel TravelPerk requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish --provider="Namelivia\TravelPerk\Laravel\TravelPerkServiceProvider"
```

This will create a `config/travelperk.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Default Connection Name

This option `default` is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `main`.

#### TravelPerk Connections

This option `connections` is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.

## Usage

#### TravelPerkManager

This is the class of most interest. It is bound to the ioc container as `travelperk` and can be accessed using the `Facades\TravelPerk` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of
[Graham Campbell's](https://github.com/GrahamCampbell) [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class
returned will always be an instance of `TravelPerk`.

#### Facades\TravelPerk

This facade will dynamically pass static method calls to the `travelperk` object in the ioc container which by default is the `TravelPerkManager` class.

#### TravelPerkServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

### Examples

Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
// You can alias this in config/app.php.
use Namelivia\TravelPerk\Laravel\Facades\TravelPerk;

TravelPerk::expenses()->invoices()->all();
// We're done here - how easy was that, it just works!
```

The TravelPerk manager will behave like it is a `TravelPerk`. If you want to call specific connections, you can do that with the connection method:

```php
use Namelivia\TravelPerk\Laravel\Facades\TravelPerk;

// Writing this…
TravelPerk::connection('main')->expenses()->invoices()->all();

// …is identical to writing this
TravelPerk::expenses()->invoices()->all();

// and is also identical to writing this.
TravelPerk::connection()->expenses()->invoices()->all();

// This is because the main connection is configured to be the default.
TravelPerk::getDefaultConnection(); // This will return main.

// We can change the default connection.
TravelPerk::setDefaultConnection('alternative'); // The default is now alternative.
```

If you prefer to use dependency injection over facades like me, then you can inject the manager:

```php
use Namelivia\TravelPerk\Laravel\TravelPerkManager;

class Foo
{
    protected $travelperk;

    public function __construct(TravelPerkManager $travelperk)
    {
        $this->travelperk = $travelperk;
    }

    public function bar()
    {
        $this->travelperk->expenses()->invoices()->all();
    }
}

App::make('Foo')->bar();
```

## Documentation

This is package is a Laravel wrapper of [travelperk-http-php](https://github.com/namelivia/travelperk-http-php). To know more about the operations you can perform with it read its documentation, and more specifically [its wiki section](https://github.com/namelivia/travelperk-http-php/wiki).

## License

[MIT](LICENSE)

## Local development

This project comes with a `docker-compose.yml` file so if you use Docker and docker-compose you can develop without installing anything on your local environment. Just run `docker-compose up --build` for the first time to setup the container and launch the tests. PHPUnit is configured as the entrypoint so just run `docker-compose up` everytime you want the tests to execute on the Dockerized PHP development container.
