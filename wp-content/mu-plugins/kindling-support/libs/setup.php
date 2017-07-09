<?php
/**
 * Kindling Support Setup.
 *
 * @package Kindling_Blade
 * @author  Matchbox Design Group <info@matchboxdesigngroup.com>
 */

use Kindling\Support\Config;

/**
 * Bind configuration
 */
kindling()->bindIf('config', Config::class, true);
