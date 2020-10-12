<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Laravel;

use Illuminate\Support\Arr;
use InvalidArgumentException;
use kamermans\OAuth2\Persistence\FileTokenPersistence;
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

    private function getConfigKeys(string $authenticationMethod): array
    {
        if ($authenticationMethod === 'oauth')
        {
            return [
                'redirect_url',
                'client_id',
                'client_secret',
                'scopes',
                'is_sandbox',
            ];
        }

        if ($authenticationMethod === 'api-key') {
            return ['api_key', 'is_sandbox'];
        }
        throw new InvalidArgumentException("Authentication method must be api-key or oauth");
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
        if (!array_key_exists('authentication_method', $config)) {
            throw new InvalidArgumentException("Authentication method missing");
        }
        $authenticationMethod = $config['authentication_method'];
        $keys = $this->getConfigKeys($authenticationMethod);

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
        if (array_key_exists('client_id', $config)) {
            return (new ServiceProvider())->buildOAuth2(
                //TODO:Let the user decide this. https://github.com/namelivia/laravel-travelperk/issues/4

                new FileTokenPersistence('/tmp/travelperk'),
                $config['client_id'],
                $config['client_secret'],
                $config['redirect_url'],
                $config['scopes'],
                $config['is_sandbox'],
            );
        }

        return (new ServiceProvider())->build(
            $config['api_key'],
            $config['is_sandbox'],
        );
    }
}
