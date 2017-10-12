<?php

ini_set("display_errors", "Off");
<<<<<<< HEAD
=======
ini_set("error_reporting", 'E_ALL & ~E_NOTICE');
>>>>>>> 218f5339f44ef81b64cc1f394373a5357960778b
// Version
define('VERSION', '2.2.0.0');

// Configuration
if (is_file('config.php')) {
	require_once('config.php');
}

// Install
if (!defined('DIR_APPLICATION')) {
	header('Location: install/index.php');
	exit;
}


// Startup
require_once(DIR_SYSTEM . 'startup.php');

$application_config = 'catalog';
// Application
require_once(DIR_SYSTEM . 'framework.php');