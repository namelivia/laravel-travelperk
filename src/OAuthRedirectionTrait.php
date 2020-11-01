<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Laravel;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Namelivia\TravelPerk\Laravel\Facades\TravelPerk;
use Namelivia\TravelPerk\OAuth\MissingCodeException;
use Throwable;

trait OAuthRedirectionTrait
{
    public static function handleOAuthRedirection(Throwable $exception)
    {
        if (is_a($exception, MissingCodeException::class)) {
            return Redirect::to(TravelPerk::getAuthUri(Request::path()));
        }
    }
}
