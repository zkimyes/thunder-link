<?php
// Version
define('VERSION', '2.2.0.0');
// Configuration
define('DEBUG',false);

// Configuration
if(constant('DEBUG')){
	if (is_file('config.php')) {
		require_once('config.php');
	}
}else{
	if (is_file('config.prod.php')) {
		require_once('config.prod.php');
	}
}


// Install
if (!defined('DIR_APPLICATION')) {
	header('Location: ../install/index.php');
	exit;
}

// Startup
require_once(DIR_SYSTEM . 'startup.php');

$application_config = 'admin';

// Application
require_once(DIR_SYSTEM . 'framework.php');