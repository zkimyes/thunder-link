<?php

// HTTP
define('HTTP_SERVER', 'http://'.$_SERVER['HTTP_HOST'].'/');

// HTTPS
define('HTTPS_SERVER', 'https://'.$_SERVER['HTTP_HOST'].'/');
$dir = $_SERVER['DOCUMENT_ROOT'];
$dir = str_replace('\\','/',$dir);
// DIR
define('DIR_APPLICATION', $dir.'/catalog/');
define('DIR_SYSTEM', $dir.'/system/');
define('DIR_IMAGE', $dir.'/image/');
define('DIR_LANGUAGE', $dir.'/catalog/language/');
define('DIR_TEMPLATE', $dir.'/catalog/view/theme/');
define('DIR_CONFIG', $dir.'/system/config/');
define('DIR_CACHE', $dir.'/system/storage/cache/');
define('DIR_DOWNLOAD', $dir.'/system/storage/download/');
define('DIR_LOGS', $dir.'/system/storage/logs/');
define('DIR_MODIFICATION', $dir.'/system/storage/modification/');
define('DIR_UPLOAD', $dir.'/system/storage/upload/');
define('DIR_VENDOR',$dir.'/vendor/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'new_thunder');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');
