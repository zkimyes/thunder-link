<?php
class ModelConfigurationBoard extends Model {

    public function getList($condition=[],$field=[],$order=""){
        $categorys = $this->db->query('
            select b.id,b.name,b.order,t.type,t.name as type_name from 
            oc_config_board as b left join oc_config_board_type as t 
            on t.id = b.border_type_id order by b.order desc
        ');
        return $categorys->rows;
    }

    public function add($data = []){
        $keys = join(',',array_keys($data));
        $values = join(',',array_values($data));
        $rs = $this->db->query("
            INSERT INTO `oc_config_board`
            (`name`,`content`, `order`,`border_type_id`)
             VALUES 
             (
                 '".$this->db->escape($data['name'])."',
                 '".$this->db->escape($data['content'])."',
                 ".intval($data['order']).",
                 ".intval($data['border_type_id'])."
                 )
        ");
        return $rs;
    }


    public function find($id=''){
        $board = $this->db->query("select * from oc_config_board where id =".intval($id));
        return $board->row;
    }


    public function update($data = []){
        $rs = $this->db->query("
                update oc_config_board set 
                `name`='".$this->db->escape($data['name'])."',
                `content`='".$this->db->escape($data['content'])."',
                `order`=".intval($data['order']).",
                border_type_id=".intval($data['border_type_id'])."
                 where id=".intval($data['id'])."
             ");
        return $rs;
    }

    public function delt($id=[]){
        if(count($id)>0){
            $id = join(',',$id);
            $rs = $this->db->query("delete from oc_config_board where id in (".$id.")");
            return $rs;
        }
        return false;
    }
}