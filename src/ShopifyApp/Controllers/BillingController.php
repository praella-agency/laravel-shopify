<?php

namespace HulkApps\ShopifyApp\Controllers;

use Illuminate\Routing\Controller;
use HulkApps\ShopifyApp\Traits\BillingControllerTrait;

/**
 * Responsible for billing a shop for plans and usage charges.
 */
class BillingController extends Controller
{
    use BillingControllerTrait;
}
