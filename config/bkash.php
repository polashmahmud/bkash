<?php

return [

    /*
   |--------------------------------------------------------------------------
   | Bkash Configurations
   |--------------------------------------------------------------------------
   |
   | This option controls the default bkash configurations that will be used
   | by the application. You can set this to a sensible default value as
   | you may easily change it throughout the application.
   |
   */

    'base_url'   => env('BKASH_BASE_URL', 'https://tokenized.sandbox.bka.sh/v1.2.0-beta'),
    'app_key'    => env('BKASH_APP_KEY', ''),
    'app_secret' => env('BKASH_APP_SECRET', ''),
    'username'   => env('BKASH_USER_NAME', ''),
    'password'   => env('BKASH_PASSWORD', '')
];
