<?php
class ModelHotSaleCategory extends Model {
	public function getList() {
        $query = $this->db->query(
            'select * from oc_hot_sale_category'
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
                (`name`,meta_desc,meta_keywords) 
                values 
                (
                    "'.$data['name'].'",
                    "'.$data['meta_keywords'].'",
                    "'.$data['meta_desc'].'"
                )'
            );
            return $query;
        }
        return null;
    }

    public function update($data){
        if(!empty($data)){
            $query = $this->db->query(
                'insert into oc_hot_sale_category 
                (`name`,meta_desc,meta_keywords) 
                values 
                (
                    "'.$data['name'].'",
                    "'.$data['meta_keywords'].'",
                    "'.$data['meta_desc'].'"
                )'
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