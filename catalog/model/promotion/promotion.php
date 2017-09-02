<?php 
/**
 * promotion
 */
class ModelPromotionPromotion extends Model {
    public function getList() {
        $query = $this->db->query(
            'select p.*,d.name,e.image,e.price from oc_promotion p left join oc_product_description d on p.product_id = d.product_id left join oc_product e on e.product_id = p.product_id order by sort_order desc'
        );
        if($query->rows){
            return $query->rows;
        }
        return null;
    }

}