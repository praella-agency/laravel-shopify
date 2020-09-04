<?php

namespace HulkApps\ShopifyApp\Controllers;

use Illuminate\Routing\Controller;
use HulkApps\ShopifyApp\Traits\WebhookControllerTrait;

/**
 * Responsible for handling incoming webhook requests.
 */
class WebhookController extends Controller
{
    use WebhookControllerTrait;
}
