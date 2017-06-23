<?php
require_once(DIR_VENDOR.'autoload.php');
//active record orm 
ORM::configure('mysql:host='.DB_HOSTNAME.';dbname='.DB_DATABASE, null, 'localhost');
ORM::configure('username', DB_USERNAME, 'localhost');
ORM::configure('password', DB_PASSWORD, 'localhost');

class base {
    public static $_connection_name = 'localhost';
}