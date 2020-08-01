<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Tests\Laravel;

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Namelivia\TravelPerk\Laravel\TravelPerkFactory;
use Namelivia\TravelPerk\Laravel\TravelPerkManager;
use Namelivia\TravelPerk\ServiceProvider;

/**
 * This is the service provider test class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testTravelPerkFactoryIsInjectable()
    {
        $this->assertIsInjectable(TravelPerkFactory::class);
    }

    public function testTravelPerkManagerIsInjectable()
    {
        $this->assertIsInjectable(TravelPerkManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(ServiceProvider::class);

        $original = $this->app['travelperk.connection'];
        $this->app['travelperk']->reconnect();
        $new = $this->app['travelperk.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
