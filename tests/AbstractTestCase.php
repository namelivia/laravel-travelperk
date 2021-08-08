<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Tests\Laravel;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Namelivia\TravelPerk\Laravel\TravelPerkServiceProvider;

/**
 * This is the abstract test class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass()
    {
        return TravelPerkServiceProvider::class;
    }
}
