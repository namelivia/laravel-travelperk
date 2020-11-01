<?php

use Illuminate\Support\Facades\Route;
use Namelivia\TravelPerk\Laravel\Http\Controllers\OAuthController;

Route::get('/oauth_callback', [OAuthController::class, 'callback'])->name('oauth-callback');
