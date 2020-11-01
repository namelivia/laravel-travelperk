<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Tests\Laravel;

use Illuminate\Support\Facades\Redirect;
use Namelivia\TravelPerk\Exceptions\NotImplementedException;
use Namelivia\TravelPerk\Laravel\Facades\TravelPerk;
use Namelivia\TravelPerk\Laravel\OAuthRedirectionTrait;
use Namelivia\TravelPerk\OAuth\MissingCodeException;

/**
 * This is the oauth redirection test class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class OAuthRedirectionTraitTest extends AbstractTestCase
{
    use OAuthRedirectionTrait;

    public function testRedirection()
    {
        $this->assertNull(OAuthRedirectionTrait::handleOAuthRedirection(new NotImplementedException()));
        TravelPerk::shouldReceive('getAuthUri');
        Redirect::shouldReceive('to')->andReturn('redirection');
        $this->assertEquals(
            'redirection',
            OAuthRedirectionTrait::handleOAuthRedirection(new MissingCodeException())
        );
    }
}
