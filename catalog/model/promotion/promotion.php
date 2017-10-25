<?php 
/**
 * promotion
 */
class ModelPromotionPromotion extends Model {
    public function getList() {
        $query = $this->db->query(
            'select p.*,d.product_id,d.name,d.description,e.image,e.price from oc_promotion p left join oc_product_description d on p.product_id = d.product_id left join oc_product e on e.product_id = p.product_id order by sort_order desc'
        );
        if($query->rows){
            return $query->rows;
        }
        return null;
    }


    public function getPromotionList($data = []){
        $sql = 'select p.*,d.name,e.image,e.price,e.quantity as pcs from oc_promotion p left join oc_product_description d on p.product_id = d.product_id left join oc_product e on e.product_id = p.product_id';
        if(isset($data['sort']) && !empty($data['sort'])){
            switch($data['sort']){
                case 'latest':
                $sql .=' order by p.id desc';
                break;
                case 'low2high':
                $sql .=' order by e.price asc';
                break;
                case 'high2low':
                $sql .=' order by e.price desc';
                break;
                default:
                $sql .=' order by p.sort_order desc';
            }
        }
        if(isset($data['limit']) && !empty($data['limit'])){
            switch($data['limit']){
                case '10':
                $sql .=' limit 10';
                break;
                case '20':
                $sql .=' limit 20';
                break;
                case '30':
                $sql .=' limit 30';
                break;
                default:
                $sql .=' limit 10';
            }
        }
        $query = $this->db->query($sql);
        if($query->rows){
            return $query->rows;
        }
        return null;
    }

}