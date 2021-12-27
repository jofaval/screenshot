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
    $url = get_value('url');

    if (!$url) {
        echo "No \"url\" param was given.\n";
        return;
    } else if (!filter_var($url, FILTER_VALIDATE_URL)) {
        echo "No valid url was given. Make sure the required HTTP protocol is there\n";
        return;
    }

    process_screenshot($url);
}