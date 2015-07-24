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
function appEnv($envKey, $default = 'Default')
{
	if(isset($_ENV[$envKey]) && !empty($_ENV[$envKey]))
		return $_ENV[$envKey];
	else
		return $default;
}
