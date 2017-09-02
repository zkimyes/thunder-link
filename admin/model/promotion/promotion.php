<?php
class ModelPromotionPromotion extends Model {
    public function getList() {
        $query = $this->db->query(
            'select p.*,d.name from oc_promotion p left join oc_product_description d on p.product_id = d.product_id order by sort_order desc'
        );
        if($query->rows){
            return $query->rows;
        }
        return null;
    }
    
    public function add($data){
        if(!empty($data)){
            $query = $this->db->query(
                'insert into oc_promotion 
                (title,product_id,`condition`,date_end,sort_order) 
                values 
                (
                    "'.$this->db->escape($data['title']).'",
                    '.(int)$data['product_id'].',
                    "'.$this->db->escape($data['condition']).'",
                    "'.$this->db->escape($data['date_end']).'",
                    '.(int)$data['sort_order'].'
                )'
            );
            return $query;
        }
        return null;
    }

    public function update($data){
        if(!empty($data)){
            $query = $this->db->query(
                'update oc_promotion 
                set title="'.$this->db->escape($data['title']).'",
                    product_id = '.(int)$data['product_id'].',
                    `condition` = "'.$this->db->escape($data['condition']).'",
                    date_end = "'.$this->db->escape($data['date_end']).'",
                    sort_order = '.(int)$data['sort_order'].'
                    where id = '.$data['id']
            );
            return $query;
        }
        return null;
    }

    public function delete($id){
        if(!empty($id)){
            $query = $this->db->query(
                'delete from oc_promotion WHERE id = '.$id
            );
            return $query;
        }
        return null;
    }


    public function find($id){
        if(!empty($id)){
            $query = $this->db->query(
                'select p.*,d.name from oc_promotion p left join oc_product_description d on p.product_id = d.product_id WHERE p.id = '.$id
            );
            return $query;
        }
        return null;
    }
}
