<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Namelivia\TravelPerk\Laravel\Facades\TravelPerk;

class OAuthController extends Controller
{
    /**
     * OAuth callback method.
     */
    public function callback(Request $request)
    {
        //TODO: Verify the state
        TravelPerk::setAuthorizationCode($request->input('code'));

        return redirect($request->input('state'));
    }
}
