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
    $response = system($script, $result);

    // Log the command executed
    logging(join(" ", [ $script, $result, $response ]));

    return $response;
}