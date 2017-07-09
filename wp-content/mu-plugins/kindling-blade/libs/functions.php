<?php
/**
 * Kindling Blade Functions.
 *
 * @package Kindling_Blade
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

/**
 * Retrieve a compiled blade view
 *
 * @param string $file
 * @param array $data
 * @return string
 */
function view($file, $data = [])
{
    return kindling('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 *
 * @param $file
 * @param array $data
 * @return string
 */
function view_path($file, $data = [])
{
    return kindling('blade')->compiledPath($file, $data);
}
