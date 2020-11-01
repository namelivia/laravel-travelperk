<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Laravel;

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Namelivia\TravelPerk\Api\TravelPerk;

/**
 * This is the TravelPerk service provider class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class TravelPerkServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/travelperk.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('travelperk.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('travelperk');
        }

        $this->mergeConfigFrom($source, 'travelperk');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('travelperk.factory', function () {
            return new TravelPerkFactory();
        });

        $this->app->alias('travelperk.factory', TravelPerkFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('travelperk', function (Container $app) {
            $config = $app['config'];
            $factory = $app['travelperk.factory'];

            return new TravelPerkManager($config, $factory);
        });

        $this->app->alias('travelperk', TravelPerkManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('travelperk.connection', function (Container $app) {
            $manager = $app['travelperk'];

            return $manager->connection();
        });

        $this->app->alias('travelperk.connection', TravelPerk::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            'travelperk',
            'travelperk.factory',
            'travelperk.connection',
        ];
    }
}
