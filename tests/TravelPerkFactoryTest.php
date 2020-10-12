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
    public function testMakeForApiKey()
    {
        $factory = $this->getTravelPerkFactory();

        $return = $factory->make([
            'authentication_method' => 'api-key',
            'api_key' => 'your-api-key',
            'is_sandbox' => true,
        ]);

        $this->assertInstanceOf(TravelPerk::class, $return);
    }

    public function testMakeForOAuth()
    {
        $factory = $this->getTravelPerkFactory();

        $return = $factory->make([
            'authentication_method' => 'oauth',
            'client_id' => 'your-client-id',
            'client_secret' => 'your-client-secret',
            'redirect_url' => 'your-redirect-url',
            'access_token_path' => '/your/access/token/path',
            'scopes' => ['expenses:read'],
            'is_sandbox' => true,
        ]);

        $this->assertInstanceOf(TravelPerk::class, $return);
    }

    public function testMakeWithNoAuthenticationMethod()
    {
        $factory = $this->getTravelPerkFactory();

        $this->expectExceptionMessage('Authentication method missing');
        $this->expectException(\InvalidArgumentException::class);
        $factory->make([]);
    }

    public function testMakeWithNoSandboxOption()
    {
        $factory = $this->getTravelPerkFactory();

        $this->expectExceptionMessage('Missing configuration key [is_sandbox].');
        $this->expectException(\InvalidArgumentException::class);
        $factory->make([
            'authentication_method' => 'api-key',
            'api_key' => 'api-key',
        ]);
    }

    public function testMakeWithInvalidAuthenticationMethod()
    {
        $factory = $this->getTravelPerkFactory();

        $this->expectExceptionMessage('Authentication method must be api-key or oauth');
        $this->expectException(\InvalidArgumentException::class);
        $factory->make([
            'authentication_method' => 'invalid',
        ]);
    }

    public function testMakeWithInvalidParamsForOAuth()
    {
        $factory = $this->getTravelPerkFactory();

        $this->expectExceptionMessage('Missing configuration key [redirect_url].');
        $this->expectException(\InvalidArgumentException::class);
        $factory->make([
            'authentication_method' => 'oauth',
            'api_key' => 'api-key',
        ]);
    }

    public function testMakeWithInvalidParamsForApiKey()
    {
        $factory = $this->getTravelPerkFactory();

        $this->expectExceptionMessage('Missing configuration key [api_key].');
        $this->expectException(\InvalidArgumentException::class);
        $factory->make([
            'authentication_method' => 'api-key',
            'client_id' => 'client-id',
        ]);
    }

    protected function getTravelPerkFactory()
    {
        return new TravelPerkFactory();
    }
}
