<?php

require_once j(LIBS_DIR, 'request-handler.php');
require_once j(ENDPOINTS_DIR, 'screenshot.php');

/**
 * Dispatch the API request
 * 
 * @return void
 */
function dispatch(): void
{
    endpoint_screenshot();
}