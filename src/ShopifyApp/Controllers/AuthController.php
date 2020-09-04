<?php

namespace HulkApps\ShopifyApp\Controllers;

use Illuminate\Routing\Controller;
use HulkApps\ShopifyApp\Traits\AuthControllerTrait;

/**
 * Responsible for authenticating the shop.
 */
class AuthController extends Controller
{
    use AuthControllerTrait;
}
