<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Tests\Laravel\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Namelivia\TravelPerk\Laravel\Facades\TravelPerk;
use Namelivia\TravelPerk\Laravel\TravelPerkManager;
use Namelivia\TravelPerk\Tests\Laravel\AbstractTestCase;

/**
 * This is the TravelPerk test class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class TravelPerkTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'travelperk';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return TravelPerk::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return TravelPerkManager::class;
    }
}
