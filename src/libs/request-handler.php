<?php

/**
 * Gets all the HTTP given params
 * 
 * @return array<string,mixed>
 */
function get_params(): array
{
    $_PUT = [];

    // Retrieve PUT and DELETE params
    $raw_content = file_get_contents('php://input');
    parse_str($raw_content, $_PUT);

    // Retrieve GET and POST params
    $params = array_merge(
        $_GET,
        $_POST,
        $_PUT,
    );

    return $params;
}

/**
 * Get the param value
 * 
 * @param string $name The name of the param value
 * @param string $default The default value, empty string if none given
 * 
 * @return string
 */
function get_value(string $name, string $default = ''): string
{
    // Get all the params
    $params = get_params();

    // If the key exists, get it
    if (isset($params[$name])) $value = $params[$name];
    // Set the default value if not found
    else $value = $default;

    // No matter where the value comes from, it gets trimmed
    $value = trim($value);

    return $value;
}

// TODO: implement POST and GET data retrieve