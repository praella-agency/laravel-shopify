<?php

namespace HulkApps\ShopifyApp\Test\Requests;

use Illuminate\Support\Facades\Validator;
use HulkApps\ShopifyApp\Facades\ShopifyApp;
use HulkApps\ShopifyApp\Requests\StoreUsageCharge;
use HulkApps\ShopifyApp\Test\TestCase;

class StoreUsageChargeRequestTest extends TestCase
{
    public function testFailsWithNoCode()
    {
        $validator = Validator::make(
            [],
            (new StoreUsageCharge())->rules()
        );

        $this->assertTrue($validator->fails());
    }

    public function testFailsForInvalidSignature()
    {
        $data = [
            'price'       => '1.00',
            'description' => 'Testing',
        ];

        $signature = ShopifyApp::createHmac(['data' => $data, 'buildQuery' => true]);
        $data['signature'] = $signature;
        $data['price'] = '2.00';

        $storeUsage = new StoreUsageCharge([], $data);
        $validator = Validator::make($data, $storeUsage->rules());
        $storeUsage->withValidator($validator);

        $this->assertTrue($validator->fails());
    }

    public function testPasses()
    {
        $data = [
            'price'       => '1.00',
            'description' => 'Testing',
        ];
        $signature = ShopifyApp::createHmac(['data' => $data, 'buildQuery' => true]);
        $data['signature'] = $signature;

        $storeUsage = new StoreUsageCharge([], $data);
        $validator = Validator::make($data, $storeUsage->rules());
        $storeUsage->withValidator($validator);

        $this->assertFalse($validator->fails());
    }
}
