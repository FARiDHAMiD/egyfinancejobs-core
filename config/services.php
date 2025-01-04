<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [

        'client_id' => '414636721224-9ca4udj6589k2ekbat1c075b6jsevrk3.apps.googleusercontent.com',

        'client_secret' => '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',

        // 'redirect' => 'https://egyfinancejobs.com/auth/google/callback',
        'redirect' => 'http://localhost:8000/auth/google/callback',
        // 'redirect' => 'http://farid.local:8000/auth/google/callback',

    ],

    'recaptcha' => [
        'key' => env('RECAPTCHA_SITE_KEY'),
        'secret' => env('RECAPTCHA_SECRET_KEY'),
        'site' => env('RECAPTCHA_SECRET_KEY'),
    ]

];
