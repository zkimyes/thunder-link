<?php
require_once(DIR_VENDOR.'autoload.php');
//active record orm 
ActiveRecord\Config::initialize(function($cfg)
{
   $cfg->set_connections(
     array(
       'development' => 'mysql://root:root@localhost/new_thunder',
       'test' => 'mysql://username:password@localhost/test_database_name',
       'production' => 'mysql://username:password@localhost/production_database_name'
     )
   );
   $cfg->set_default_connection('development');
});


class base extends ActiveRecord\Model{
    
}