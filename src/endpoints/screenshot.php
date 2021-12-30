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
 * @param int|null $width The width of the browser agent and screenshot, by default `null`.
 * @param int|null $height The height of the browser agent and screenshot, by default `null`.
 * @param string $browser The browser to be used, by default `firefox`.
 * @param string|null $header The user agents header, string format, by default `null`.
 * @param string $format The return value format, by default `base64`.
 * 
 * @return void
 */
function process_screenshot(
    string $url,
    int $width = null,
    int $height = null,
    string $browser = BROWSER_FIREFOX,
    string $header = null,
    string $format = FORMAT_BASE64
): void
{
    // Get all the params
    $params = [
        'width'   => $width,
        'height'  => $height,
        'browser' => $browser,
        'header'  => $header,
        'format'  => $format,
    ];

    // Don't parse incorrect values
    $params = array_filter($params, function ($value)
    {
        return !is_null($value) && $value;
    });

    // Parse to JSON
    $configuration = json_encode($params);

    $script = join(" ", [
        PYTHON,
        SCREENSHOT_FILE,
        $url,
        urlencode($configuration)
    ]);

    // Executes the script
    $result = command($script);
    // Parse the img path
    $img_path = get_screenshot_path($result);

    // Log the request
    logging("Requested: \"$url\", answered with: \"$img_path\"");

    // Output the value
    switch ($format) {
        default:
        case FORMAT_BASE64:
            // Parse the img content
            $img = imgToBase64($img_path);
            break;
        case FORMAT_VISUAL:
            // Parse the img content
            $img = visualizeImage($img_path);
            break;
    }

    // Delete the screenshot after it gets displayed to the user
    if (file_exists($img_path)) unlink($img_path);

    // TODO: implement a global delete for the folder, just in case
}

/**
 * Implements the screenshot endpoint
 * 
 * @return void
 */
function endpoint_screenshot(): void
{
    $url = get_value('url');

    if (!$url) {
        echo "No \"url\" param was given.\n";
        return;
    } else if (!filter_var($url, FILTER_VALIDATE_URL)) {
        echo "No valid url was given. Make sure the required HTTP protocol is there\n";
        return;
    }

    // Get the width value
    $width = get_value('width', null);

    // Get the height value
    $height = get_value('height', null);

    // Get the browser value
    $browser = get_value('browser', BROWSER_FIREFOX);

    // Get the header value
    $header = get_value('header', null);

    // Get the format value
    $format = get_value('format', FORMAT_BASE64);

    process_screenshot($url, $width, $height, $browser, $header, $format);
}