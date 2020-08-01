<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the TravelPerk facade class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class TravelPerk extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'travelperk';
    }
}
