<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Laravel;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;
use Namelivia\TravelPerk\Api\TravelPerk;

/**
 * This is the TravelPerk manager class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class TravelPerkManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Namelivia\TravelPerk\Laravel\TravelPerkFactory
     */
    private $factory;

    /**
     * Create a new TravelPerk manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Namelivia\TravelPerk\Laravel\TravelPerkFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, TravelPerkFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \Namelivia\TravelPerk\Api\TravelPerk
     */
    protected function createConnection(array $config): TravelPerk
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName(): string
    {
        return 'travelperk';
    }

    /**
     * Get the factory instance.
     *
     * @return  \Namelivia\TravelPerk\Laravel\TravelPerkFactory
     */
    public function getFactory(): TravelPerkFactory
    {
        return $this->factory;
    }
}
