<?php

namespace HulkApps\ShopifyApp\Test\Stubs;

use HulkApps\ShopifyApp\Models\Shop as BaseShop;

class ShopModelStub extends BaseShop
{
    protected $table = 'shops';

    public function hello()
    {
        return 'hello';
    }
}
