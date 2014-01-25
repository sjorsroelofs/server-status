<?php

/**
 * Settings
 *
 * If you're not using Boxcar, you can leave the Boxcar values blank
 * If you're using push, you NEED to insert the Boxcar values
 */
define('SEND_EMAIL',		true);
define('SEND_PUSH',			false);
define('PRINT_HTML',		true);
define('USER_EMAIL',		'');
define('BOXCAR_API_KEY',	'');
define('BOXCAR_API_SEC',	'');
define('BOXCAR_EMAIL',		'');

/**
 * Set your timezone
 */
date_default_timezone_set('Europe/Amsterdam');