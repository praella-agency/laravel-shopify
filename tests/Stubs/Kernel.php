<?php

namespace HulkApps\ShopifyApp\Test\Stubs;

class Kernel extends \Orchestra\Testbench\Http\Kernel
{
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'       => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'   => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can'        => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'      => Middleware\RedirectIfAuthenticated::class,
        'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,

        // Added for testing
        'auth.shop'    => \HulkApps\ShopifyApp\Middleware\AuthShop::class,
        'auth.webhook' => \HulkApps\ShopifyApp\Middleware\AuthWebhook::class,
        'auth.proxy'   => \HulkApps\ShopifyApp\Middleware\AuthProxy::class,
        'billable'     => \HulkApps\ShopifyApp\Middleware\Billable::class,
    ];
}
