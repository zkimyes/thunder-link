<?php
class ModelConfigurationTypical extends Model {

    public function getList($condition=[],$field=[],$order=""){
        $typical = $this->db->query('SELECT t.id,t.name,t.blueprint,t.sort_order,c.name as category_name, p.image FROM `oc_config_typical` as t LEFT JOIN oc_config_category as c on c.category_id = t.category_id LEFT JOIN oc_product as p on p.product_id = t.link_product_id');
        return $typical->rows;
    }

    public function add($data = []){
        $sql = "
            INSERT INTO `oc_config_typical`
            (`category_id`, `name`, `description`, `link_product_id`, `parameter`, `blueprint`, `link_boards`, `sort_order`) 
            VALUES (
                ".intval($data['category_id']).",
                '".$this->db->escape($data['name'])."',
                '',
                ".intval($data['link_product_id']).",
                '".$this->db->escape(isset($data['parameter'])?json_encode($data['parameter'],true):'')."',
                '".$this->db->escape($data['blueprint'])."',
                '".$this->db->escape(json_encode($data['link_boards'],true))."',
                ".intval($data['sort_order'])."
                )
            ";
        $rs = $this->db->query($sql);
        return $rs;
    }


    public function find($id=''){
        $typical = $this->db->query("
            select 
            typical.*,
            product.image,
            product_desc.name as product_name
            from oc_config_typical typical 
            left join oc_product_description as product_desc on typical.link_product_id = product_desc.product_id 
            left join oc_product as product on typical.link_product_id = product.product_id
            where typical.id =".intval($id));
        return $typical->row;
    }


    public function update($data = []){
        $rs = $this->db->query("
                update oc_config_typical 
                set category_id = ".intval($data['category_id']).",
                `name`='".$this->db->escape($data['name'])."',
                link_product_id = ".intval($data['link_product_id']).",
                parameter = '".$this->db->escape(json_encode($data['parameter']))."',
                blueprint = '".$this->db->escape($data['blueprint'])."',
                link_boards = '".$this->db->escape(json_encode($data['link_boards']))."',
                sort_order=".intval($data['sort_order'])."
                 where id=".intval($data['id'])."
             ");
        return $rs;
    }

    public function delt($id=[]){
        if(count($id)>0){
            $id = join(',',$id);
            $rs = $this->db->query("delete from oc_config_typical where id in (".$id.")");
            return $rs;
        }
        return false;
    }

}