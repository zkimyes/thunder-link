<?php
class ModelConfigurationTypical extends Model {

    public function getList($condition=[],$field=[],$order=""){
        $typical = $this->db->query('select a.id,a.`name`,a.image,a.sort_order,a.blueprint,c.`name` as category_name from oc_config_typical as a left join oc_config_category as c on c.category_id = a.category_id');
        return $typical->rows;
    }

    public function add($data = []){
        $keys = join(',',array_keys($data));
        $values = join(',',array_values($data));
        $rs = $this->db->query("
            INSERT INTO `oc_config_category`
            (`name`, `image`, `sort_order`, `description`, `meta_title`, `meta_description`, `meta_keyword`, `banner`)
             VALUES 
             (
                 '".$this->db->escape($data['name'])."',
                 '".$this->db->escape($data['image'])."',
                 ".intval($data['sort_order']).",
                 '".$this->db->escape($data['description'])."',
                 '".$this->db->escape($data['meta_title'])."',
                 '".$this->db->escape($data['meta_description'])."',
                 '".$this->db->escape($data['meta_keyword'])."',
                 ".intval($data['banner'])."
                 )
        ");
        return $rs;
    }


    public function find($id=''){
        $typical = $this->db->query("select * from oc_config_typical where id =".intval($id));
        return $typical->row;
    }


    public function update($data = []){
        $rs = $this->db->query("
                update oc_config_category set `name`='".$this->db->escape($data['name'])."',
                meta_title='".$this->db->escape($data['meta_title'])."',
                meta_description='".$this->db->escape($data['meta_description'])."',
                meta_keyword='".$this->db->escape($data['meta_keyword'])."',
                image='".$this->db->escape($data['image'])."',
                sort_order=".intval($data['sort_order']).",
                banner=".intval($data['banner'])."
                 where category_id=".intval($data['category_id'])."
             ");
        return $rs;
    }

    public function delt($id=[]){
        if(count($id)>0){
            $id = join(',',$id);
            $rs = $this->db->query("delete from oc_config_category where category_id in (".$id.")");
            return $rs;
        }
        return false;
    }
}