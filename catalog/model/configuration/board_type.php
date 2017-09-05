<?php
/**
 *  主板类型
 */
class ModelConfigurationBoardType extends Model {

    public function getList($condition=[],$field=[],$limit=3,$order=""){
        $sql = "SELECT * FROM `oc_config_board_type`";
        $types = $this->db->query($sql);
        return $types->rows;
    }

}