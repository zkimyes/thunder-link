<?php
// HTTP
define('HTTP_SERVER', 'http://'.$_SERVER['HTTP_HOST'].'/admin/');
define('HTTP_CATALOG', 'http://'.$_SERVER['HTTP_HOST'].'/');

$dir = $_SERVER['DOCUMENT_ROOT'];
$dir = str_replace('\\','/',$dir);

// HTTPS
define('HTTPS_SERVER', 'https://'.$_SERVER['HTTP_HOST'].'/admin/');
define('HTTPS_CATALOG', 'https://'.$_SERVER['HTTP_HOST'].'/');
// DIR
define('DIR_APPLICATION', $dir.'/admin/');
define('DIR_SYSTEM', $dir.'/system/');
define('DIR_IMAGE', $dir.'/image/');
define('DIR_LANGUAGE', $dir.'/admin/language/');
define('DIR_TEMPLATE', $dir.'/admin/view/template/');
define('DIR_CONFIG', $dir.'/system/config/');
define('DIR_CACHE', $dir.'/system/storage/cache/');
define('DIR_DOWNLOAD', $dir.'/system/storage/download/');
define('DIR_LOGS', $dir.'/system/storage/logs/');
define('DIR_MODIFICATION', $dir.'/system/storage/modification/');
define('DIR_UPLOAD', $dir.'/system/storage/upload/');
define('DIR_CATALOG', $dir.'/catalog/');
define('DIR_VENDOR',$dir.'/vendor/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'CQsdlk123~thunderlink');
define('DB_DATABASE', 'thunder-link');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');
