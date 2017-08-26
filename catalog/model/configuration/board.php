<?php
/**
 *  主板
 */
class ModelConfigurationBoard extends Model {

    public function getBoardByType($condition=[],$field=[],$limit=3,$order=""){
        $sql = "SELECT * FROM `oc_config_board`";
        if($condition['type']){
            $sql .=" where border_type_id = ".(int)$condition['type'];
        }

        $sql .=" order by `order` desc";
        $types = $this->db->query($sql);
        return $types->rows;
    }

}