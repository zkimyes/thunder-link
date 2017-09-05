<?php
/**
 *  主板
 */
class ModelConfigurationBoard extends Model {

    public function getBoardByType($condition=[],$field=[],$limit=3,$order=""){
        $sql = "SELECT a.*,b.type FROM `oc_config_board` a left join oc_config_board_type b on a.border_type_id = b.id";
        if($condition['type']){
            $sql .=" where a.border_type_id = ".(int)$condition['type'];
        }

        $sql .=" order by a.`order` desc";
        $types = $this->db->query($sql);
        return $types->rows;
    }

}