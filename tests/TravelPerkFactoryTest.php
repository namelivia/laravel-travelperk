<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Tests\Laravel;

use Namelivia\TravelPerk\Api\TravelPerk;
use Namelivia\TravelPerk\Laravel\TravelPerkFactory;

/**
 * This is the TravelPerk factory test class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class TravelPerkFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getTravelPerkFactory();

        $return = $factory->make([
            'api_key' => 'your-api-key'
        ]);

        $this->assertInstanceOf(TravelPerk::class, $return);
    }

    public function testMakeWithoutApiKey()
    {
        $factory = $this->getTravelPerkFactory();

        $this->expectException(\InvalidArgumentException::class);
        $factory->make([]);
    }

    protected function getTravelPerkFactory()
    {
        return new TravelPerkFactory();
    }
}
