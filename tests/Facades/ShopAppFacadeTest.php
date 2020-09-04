<?php

namespace HulkApps\ShopifyApp\Test\Facades;

use HulkApps\ShopifyApp\Facades\ShopifyApp;
use HulkApps\ShopifyApp\Test\TestCase;
use ReflectionMethod;

class ShopAppFacadeTest extends TestCase
{
    public function testBasic()
    {
        $method = new ReflectionMethod(ShopifyApp::class, 'getFacadeAccessor');
        $method->setAccessible(true);

        $this->assertEquals('shopifyapp', $method->invoke(null));
    }
}
