<?php

ini_set("display_errors", "On");
ini_set("error_reporting", 'E_ALL & ~E_NOTICE');
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