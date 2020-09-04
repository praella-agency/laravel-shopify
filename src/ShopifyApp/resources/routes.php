<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| All the routes for the Shopify App setup.
|
*/

Route::group(['prefix' => config('shopify-app.prefix'), 'middleware' => ['web']], function () {
    /*
    |--------------------------------------------------------------------------
    | Home Route
    |--------------------------------------------------------------------------
    |
    | Homepage for an authenticated store. Store is checked with the auth.shop
    | middleware and redirected to login if not.
    |
    */

    Route::get(
        '/',
        'HulkApps\ShopifyApp\Controllers\HomeController@index'
    )
    ->middleware(['auth.shop', 'billable'])
    ->name('home');

    /*
    |--------------------------------------------------------------------------
    | Login Route
    |--------------------------------------------------------------------------
    |
    | Allows a shop to login/install.
    |
    */

    Route::get(
        '/login',
        'HulkApps\ShopifyApp\Controllers\AuthController@index'
    )->name('login');

    /*
    |--------------------------------------------------------------------------
    | Authenticate Method
    |--------------------------------------------------------------------------
    |
    | Authenticates a shop fully or partially.
    |
    */

    Route::match(
        ['get', 'post'],
        '/authenticate',
        'HulkApps\ShopifyApp\Controllers\AuthController@authenticate'
    )
    ->name('authenticate');

    /*
    |--------------------------------------------------------------------------
    | Billing Handler
    |--------------------------------------------------------------------------
    |
    | Billing handler. Sends to billing screen for Shopify.
    |
    */

    Route::get(
        '/billing/{plan?}',
        'HulkApps\ShopifyApp\Controllers\BillingController@index'
    )
    ->middleware(['auth.shop'])
    ->where('plan', '^([0-9]+|)$')
    ->name('billing');

    /*
    |--------------------------------------------------------------------------
    | Billing Processor
    |--------------------------------------------------------------------------
    |
    | Processes the customer's response to the billing screen.
    |
    */

    Route::get(
        '/billing/process/{plan?}',
        'HulkApps\ShopifyApp\Controllers\BillingController@process'
    )
    ->middleware(['auth.shop'])
    ->where('plan', '^([0-9]+|)$')
    ->name('billing.process');

    /*
    |--------------------------------------------------------------------------
    | Billing Processor for Usage Charges
    |--------------------------------------------------------------------------
    |
    | Creates a usage charge on a recurring charge.
    |
    */

    Route::match(
        ['get', 'post'],
        '/billing/usage-charge',
        'HulkApps\ShopifyApp\Controllers\BillingController@usageCharge'
    )
    ->middleware(['auth.shop'])
    ->name('billing.usage_charge');
});

Route::group(['middleware' => ['api']], function () {
    /*
    |--------------------------------------------------------------------------
    | Webhook Handler
    |--------------------------------------------------------------------------
    |
    | Handles incoming webhooks.
    |
    */

    Route::post(
        '/webhook/{type}',
        'HulkApps\ShopifyApp\Controllers\WebhookController@handle'
    )
    ->middleware('auth.webhook')
    ->name('webhook');
});
