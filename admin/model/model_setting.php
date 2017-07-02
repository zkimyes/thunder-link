<?php
require_once(DIR_VENDOR.'/autoload.php');
$dsn ='mysql:dbname='.DB_DATABASE.';host='.DB_HOSTNAME;
$db = new PDO($dsn,DB_USERNAME,DB_PASSWORD);
ActiveRecord::setDb($db);