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
            $rs = $this->db->query("delete from oc_config_category where category_id in (".$id.")");
            return $rs;
        }
        return false;
    }

}