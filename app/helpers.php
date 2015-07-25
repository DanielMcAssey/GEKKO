<?php

/*
|--------------------------------------------------------------------------
| Helper Functions
|--------------------------------------------------------------------------
|
| Here is where you can place additional helper functions
|
*/

/**
 * Get environment variable
 *
 * @return String
 */
function appEnv($envKey, $default)
{
	if(isset($_ENV[$envKey]))
		return $_ENV[$envKey];
	else
		return $default;
}
