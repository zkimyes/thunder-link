<?php
/**
 * hot sale 目录
 */
require_once(DIR_VENDOR.'autoload.php');
//active record orm 
ORM::configure('mysql:host='.DB_HOSTNAME.';dbname='.DB_DATABASE, null, 'localhost');
ORM::configure('username', DB_USERNAME, 'localhost');
ORM::configure('password', DB_PASSWORD, 'localhost');

class HotSaleCategory{
    public function getA(){
        var_dump(ORM);
        return ORM::for_table('oc_hot_sale_category')->find_many();
    }
}