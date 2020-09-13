<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Laravel;

use Illuminate\Support\Arr;
use InvalidArgumentException;
use Namelivia\TravelPerk\Api\TravelPerk;
use Namelivia\TravelPerk\ServiceProvider;

/**
 * This is the TravelPerk factory class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class TravelPerkFactory
{
    /**
     * Make a new TravelPerk client.
     *
     * @param array $config
     *
     * @return \Namelivia\TravelPerk\Api\TravelPerk
     */
    public function make(array $config): TravelPerk
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config): array
    {
        $keys = [
            'api_key',
            'is_sandbox',
        ];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return Arr::only($config, $keys);
    }

    /**
     * Get the TravelPerk client.
     *
     * @param string[] $config
     *
     * @return \Namelivia\TravelPerk\Api\TravelPerk
     */
    protected function getClient(array $config): TravelPerk
    {
        return (new ServiceProvider())->build(
            $config['api_key'],
            $config['is_sanbox'],
        );
    }
}
