<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Tests\Laravel;

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use Namelivia\TravelPerk\Api\TravelPerk;
use Namelivia\TravelPerk\Laravel\TravelPerkFactory;
use Namelivia\TravelPerk\Laravel\TravelPerkManager;

/**
 * This is the TravelPerk manager test class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class TravelPerkManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('travelperk.default')->andReturn('travelperk');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(TravelPerk::class, $return);

        $this->assertArrayHasKey('travelperk', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock(Repository::class);
        $factory = Mockery::mock(TravelPerkFactory::class);

        $manager = new TravelPerkManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('travelperk.connections')->andReturn(['travelperk' => $config]);

        $config['name'] = 'travelperk';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(TravelPerk::class));

        return $manager;
    }
}
