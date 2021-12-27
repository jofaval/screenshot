<?php

/**
 * Executes a command and returns it's response
 * 
 * @param string $script The command to execute
 * 
 * @return string
 */
function command(string $script): string
{
    // While executing the command, no extra string will be printed
    ob_start();
    $response = system($script, $result);
    ob_get_clean();

    // Log the command executed
    // logging(join(" ", [ $script, $result, $response ]));

    return $response;
}