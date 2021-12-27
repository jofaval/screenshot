<?php

require_once j(LIBS_DIR, 'system.php');
require_once j(LIBS_DIR, 'img.php');

/**
 * Get the screenshot path
 * 
 * @param string $result The script response
 * 
 * @return string
 */
function get_screenshot_path(string $result): string
{
    $img = '';

    // Parse the respones
    parse_str($result, $response);
    // If it doesn't exist return the default value
    if (!isset($response['screenshot'])) return $img;

    // Reassign the new value
    $img = $response['screenshot'];

    return $img;
}

/**
 * Process the screenshot API logic
 * 
 * @param string $url The site web location.
 * @param int $width The width of the browser agent and screenshot, by default `null`.
 * @param int $height The height of the browser agent and screenshot, by default `null`.
 * @param string $browser The browser to be used, by default `firefox`.
 * @param string $header The user agents header, string format, by default `null`.
 * @param string $format The return value format, by default `base64`.
 * 
 * @return void
 */
function process_screenshot(
    string $url,
    int $width = null,
    int $height = null,
    string $browser = 'firefox',
    string $header = null,
    string $format = FORMAT_BASE64
): void
{
    $configuration = json_encode([
        'width'   => $width,
        'height'  => $height,
        'browser' => $browser,
        'header'  => $header,
        'format'  => $format,
    ]);

    $script = join(" ", [
        PYTHON,
        SCREENSHOT_FILE,
        $url,
        "\'$configuration\'"
    ]);

    // Executes the script
    $result = command($script);
    // Parse the img path
    $img_path = get_screenshot_path($result);

    // Log the request
    logging("Requested: \"$url\", answered with: \"$img_path\"");

    // Output the value
    switch ($format) {
        case FORMAT_BASE64:
            // Parse the img content
            $img = imgToBase64($img_path);
            break;
        case FORMAT_VISUAL:
            // Parse the img content
            $img = visualizeImage($img_path);
            break;
        
        default:
            // Parse the img content
            $img = imgToBase64($img_path);
            break;
    }
}