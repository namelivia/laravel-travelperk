<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Laravel;

use Throwable;
use Namelivia\TravelPerk\OAuth\MissingCodeException;
use Namelivia\TravelPerk\Laravel\Facades\TravelPerk;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

trait OAuthRedirectionTrait {

    static function handleOAuthRedirection(Throwable $exception) {
        if (is_a($exception, MissingCodeException::class)) {
            return Redirect::to(TravelPerk::getAuthUri(Request::path()));
        }
    }

}
