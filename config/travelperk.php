<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | TravelPerk Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your connection. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'api_key' => env('TRAVELPERK_API_KEY', 'your-api-key'),
            'client_id' => env('TRAVELPERK_CLIENT_ID', 'your-client-id'),
            'client_secret' => env('TRAVELPERK_CLIENT_SECRET', 'your-client-secret'),
            'redirect_url' => env('TRAVELPERK_REDIRECT_URL', 'your-redirect-url'),
            'is_sandbox' => false,
        ],

        'alternative' => [
            'api_key' => 'your-api-key',
            'client_id' => 'your-client-id',
            'client_secret' => 'your-client-secret',
            'redirect_url' => 'your-redirect-url',
            'is_sandbox' => false,
        ],

    ],

];
