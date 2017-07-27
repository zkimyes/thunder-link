<?php
class ModelConfigurationBoardType extends Model {

    public function getList($condition=[],$field=[],$order=""){
        $types = $this->db->query('select * from oc_config_board_type');
        return $types->rows;
    }

    public function add($data = []){
        $keys = join(',',array_keys($data));
        $values = join(',',array_values($data));
        $rs = $this->db->query("
            INSERT INTO `oc_config_board_type`
            (`name`, `type`, `order`)
             VALUES 
             (
                 '".$this->db->escape($data['name'])."',
                 ".intval($data['order']).",
                 ".intval($data['order'])."
                 )
        ");
        return $rs;
    }


    public function find($id=''){
        $type = $this->db->query("select * from oc_config_board_type where id =".intval($id));
        return $type->row;
    }


    public function update($data = []){
        $rs = $this->db->query("
                update oc_config_board_type set 
                `name`='".$this->db->escape($data['name'])."',
                type=".intval($data['type']).",
                `order`=".intval($data['order'])."
                 where id=".intval($data['id'])."");
        return $rs;
    }

    public function delt($id=[]){
        if(count($id)>0){
            $id = join(',',$id);
            $rs = $this->db->query("delete from oc_config_board_type where id in (".$id.")");
            return $rs;
        }
        return false;
    }
}