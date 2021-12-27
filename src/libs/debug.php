<?php

/**
 * Prints all the values and stops the execution
 * 
 * @return void
 */
function dd(): void
{
    // Get all the values to print
    $values = func_get_args();

    // Format the output values
    echo "<pre style='font-size: 16px; color: hsl(0, 50%, 30%);'>";
        foreach ($values as $value) var_dump($value);
    echo "</pre>";

    // Stop the execution
    die;
}

/**
 * Catches and handles an exception/error throwed in the app
 * 
 * @param Throwable $throwed The exception/error throwed in the app
 * @param bool $display Determines wether it should display the details, it won't by default
 * 
 * @return void
 */
function general_exception_handler(Throwable $throwed, bool $display = false)
{
    // Log the error
    logging($throwed->__toString());

    if ($display) dd($throwed);
}

set_exception_handler('general_exception_handler');

/**
 * Catches and handlers an error throwed in the app
 * 
 * @param int $errno The error code
 * @param string $errstr The message it throwed
 * @param string $errfile The file where it happend
 * @param int $errline The line of the file where it happened
 * @param array $errcontext The context of the error
 * @param bool $display Determines wether it should display the details, it won't by default
 * 
 * @return void
 */
function general_error_handler(int $errno, string $errstr, string $errfile, int $errline, array $errcontext, bool $display = false): void
{
    $message = "An error [code:$errno] with message \"$errstr\" at '$errfile:$errline'";
    logging($message);

    if ($display) dd($message);
}

set_error_handler('general_error_handler');

/**
 * Logs information
 * 
 * @param string $message The information to log
 * @param string $file The file path, by default the LOG_FILE
 * 
 * @return bool
 */
function logging(string $message, string $file = LOG_FILE): bool
{
    // If the directory doesn't exist, create it
    if (!file_exists(dirname($file))) {
        mkdir(dirname($file), 0777, true);
    }
    // If the file doesn't exist, create it
    if (!file_exists($file)) {
        touch($file);
    }

    // Add jumpline at the end of the string
    if ($message[strlen($message) - 1] !== PHP_EOL) $message .= PHP_EOL;

    // Add timestamp
    $message = date('[d/m/Y H:i:s]') . " " . $message;

    // Appends the content
    $success = file_put_contents($file, $message, FILE_APPEND);

    return $success;
}