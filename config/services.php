<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '1820574464892682',
        'client_secret' => 'e30504fd57f8b5f570fc39cd352dab5c',
        'redirect' => 'http://blog.local/auth/facebook/callback', //URL::route('auth.facebook.callback')
    ],
    'twitter' => [
        'client_id' => 'u6ZdU3Z8w1kbMz3VGyUXRIL4f',
        'client_secret' => 'FziTe5gbEMyMhPj7xSYK3ojFZlnDRQu1ChghSvQcPic6MRP8QV',
        'redirect' => 'http://blog.local/auth/twitter/callback', //URL::route('auth.twitter.callback')
    ],
    'google' => [
        'client_id' => '234500376709-s3tcao9no45v2s32er83rscs0qse8i60.apps.googleusercontent.com',
        'client_secret' => 'hPs7_a-K1xi_Vwl2FHBjedvO',
        'redirect' => 'http://127.0.0.1/blog/public/auth/google/callback'
        //'http://blog.local/auth/google/callback', //URL::route('auth.google.callback')
    ],
    'linkedin' => [
        'client_id' => '81z5kl5q82wmqr',
        'client_secret' => 'yFL27TKgFaInYrqK',
        'redirect' => 'http://blog.local/auth/linkedin/callback', //URL::route('auth.linkedin.callback')
    ],
    'github' => [
        'client_id' => 'a7aefed72342cce2d766',
        'client_secret' => 'c062c16fa5f9db6b6e2cf744770935a1ec835083',
        'redirect' => 'http://blog.local/auth/github/callback', //URL::route('auth.github.callback')
    ],
    'bitbucket' => [
        'client_id' => 'wN3RJZeyDtnnSPStry',
        'client_secret' => 'Fc93WEJCmeBhPkHnsYPdYSp8RSHtf3Ts',
        'redirect' => 'http://blog.local/auth/bitbucket/callback', //URL::route('auth.bitbucket.callback')
    ],
];
