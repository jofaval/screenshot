<?php

/**
 * Joins all the given directory paths
 * 
 * @param string[] $args All the paths to join
 * 
 * @return string
 */
function j(): string
{
    $paths = func_get_args();

    // Every acknowledged separator
    $separators = [ '/', '\/' ];

    $paths = array_map(function (string $path) use ($separators)
    {
        $path_as_array = str_split($path);

        // If it's starts with a separator, remove it
        if (in_array($path[0], $separators)) {
            array_slice($path_as_array, 1, strlen($path));

            // Reexplode
            $path_as_array = str_split($path);
        }

        // If it's ends with a separator, remove it
        if (in_array($path[strlen($path) - 2], $separators)) {
            array_slice($path_as_array, 1, strlen($path));

            // Reexplode
            $path_as_array = str_split($path);
        }

        // If it has any other separator, replace it with the constant value
        foreach ($path_as_array as $key => $char) {
            // If it's not a separator, continue
            if (!in_array($char, $separators))  continue;

            // If it is, replace it with the constant
            $path[$key] = DIRECTORY_SEPARATOR;
        }

        return join('', $path_as_array);
    }, $paths);

    // Join all the paths
    return join(DIRECTORY_SEPARATOR, $paths);
}