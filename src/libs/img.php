<?php

/**
 * Visualizes and img on the buffer
 * 
 * @param string $img The img path
 * 
 * @return void
 */
function visualizeImage(string $img): void
{
    // Set the correct header
    header("Content-type: image/png");

    $content = '';
    // If the file doesn't exist return as empty
    if (file_exists($img)) $content = file_get_contents($img);

    // Print it
    echo $content;
}

/**
 * Converts an img to base64
 * 
 * @param string $img The img path
 * 
 * @return string
 */
function imgToBase64(string $img): string
{
    $encoded = '';
    // If the file doesn't exist return as empty
    if (!file_exists($img)) return $encoded;

    // Retrieve the content
    $content = file_get_contents($img);
    // And encode it
    $encoded = base64_encode($content);

    // Echo the encoded content
    echo $encoded;

    return $encoded;
}