<?php
/**
 * 典型配置
 */
class ModelConfigurationTypical extends Model {

    public function getList($condition=[],$field=[],$limit=3,$order=""){
        $sql = 'SELECT ';
        $sql .="t.*,c.name as category_name, p.image ";

        $sql .="FROM `oc_config_typical` as t LEFT JOIN oc_config_category as c on c.category_id = t.category_id LEFT JOIN oc_product as p on p.product_id = t.link_product_id ";

        if($condition['category_id']){
            $sql .="where t.category_id = ".intval($condition['category_id']);
        }
        
        $typical = $this->db->query($sql);
        return $typical->rows;
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