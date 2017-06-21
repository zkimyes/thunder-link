<?php 
require_once DIR_APPLICATION.'/model/base_model.php';
class Promotion extends base {
    static $table_name = 'oc_promotion';
    static $belongs_to = array(     
        array('product')
  );


    public function install(){
        $sql = "CREATE TABLE `new_thunder`.`oc_promotion` ( `id` INT NOT NULL , `name` VARCHAR(200) NULL DEFAULT NULL COMMENT '标题' , `product_id` INT NULL DEFAULT NULL COMMENT '关联的产品id' , `date_end` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '促销结束的时间' , `descs` VARCHAR(600) NULL DEFAULT NULL COMMENT '促销的描述' , `conditions` VARCHAR(500) NULL DEFAULT NULL COMMENT '促销的条件' ) ENGINE = InnoDB";
    }

    public function getHomePromotions(){
        return $this->find('all');
    }
}