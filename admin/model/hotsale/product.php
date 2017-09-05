<?php
class ModelHotSaleProduct extends Model {
	public function getList() {
        $query = $this->db->query(
            'select s.*,d.name as name from oc_hot_sale_product s left join oc_product_description d on s.product_id = d.product_id order by sort_order desc'
        );
        if($query->rows){
            return $query->rows;
        }
        return null;
	}


    public function add($data){
        if(!empty($data)){
            $query = $this->db->query(
                'insert into oc_hot_sale_product 
                (category_id,product_id,sort_order,is_home) 
                values 
                (
                    '.(int)$data['category_id'].',
                    '.(int)$data['product_id'].',
                    '.(int)$data['sort_order'].',
                    '.(int)$data['is_home'].'
                )'
            );
            return $query;
        }
        return null;
    }

    public function update($data){
        if(!empty($data)){
            $query = $this->db->query(
                'update oc_hot_sale_product 
                set category_id='.(int)$data['category_id'].',
                    product_id = '.(int)$data['product_id'].',
                    sort_order = '.(int)$data['sort_order'].',
                    is_home = '.(int)$data['is_home'].'
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
                'delete from oc_hot_sale_product WHERE id = '.$id
            );
            return $query;
        }
        return null;
    }


    public function find($id){
        if(!empty($id)){
            $query = $this->db->query(
                'select s.*,d.name from oc_hot_sale_product s left join oc_product_description d on s.product_id = d.product_id WHERE s.id = '.$id
            );
            return $query;
        }
        return null;
    }
}