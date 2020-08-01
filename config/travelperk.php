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
        ],

        'alternative' => [
            'api_ket' => 'your-client-id',
        ],

    ],

];
