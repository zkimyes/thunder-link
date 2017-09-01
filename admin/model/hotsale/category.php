<?php
class ModelHotSaleCategory extends Model {
	public function getList() {
        $query = $this->db->query(
            'select * from oc_hot_sale_category order by id desc'
        );
        if($query->rows){
            return $query->rows;
        }
        return null;
	}


    public function add($data){
        if(!empty($data)){
            $query = $this->db->query(
                'insert into oc_hot_sale_category 
                (`name`,meta_desc,meta_keywords,sort_order) 
                values 
                (
                    "'.$this->db->escape($data['name']).'",
                    "'.$this->db->escape($data['meta_desc']).'",
                    "'.$this->db->escape($data['meta_keywords']).'",
                    "'.(int)$data['sort_order'].'"
                )'
            );
            return $query;
        }
        return null;
    }

    public function update($data){
        if(!empty($data)){
            $query = $this->db->query(
                'update oc_hot_sale_category 
                set `name`="'.$this->db->escape($data['name']).'",
                    meta_keywords = "'.$this->db->escape($data['meta_keywords']).'",
                    meta_desc = "'.$this->db->escape($data['meta_desc']).'",
                    sort_order = '.(int)$data['sort_order'].'
                where id = 
                '.$data['id']
            );
            return $query;
        }
        return null;
    }

    public function delete($id){
        if(!empty($id)){
            $query = $this->db->query(
                'delete from oc_hot_sale_category WHERE id = '.$id
            );
            return $query;
        }
        return null;
    }


    public function find($id){
        if(!empty($id)){
            $query = $this->db->query(
                'select * from oc_hot_sale_category WHERE id = '.$id
            );
            return $query;
        }
        return null;
    }
}