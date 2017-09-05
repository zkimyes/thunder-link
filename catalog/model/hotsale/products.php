<?php
/**
 * hot sale 产品
 */
class ModelHotSaleProducts extends Model {

    public function getHomeHotSaleList(){
        $limit = 4;
        $sql = "select a.*,p.image,p.price,d.name from oc_hot_sale_product a left join oc_product p on a.product_id = p.product_id left join oc_product_description d
         on a.product_id = d.product_id order by a.sort_order desc limit ".$limit;
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function getHotSaleCategroy(){
        $sql = "select id,name from oc_hot_sale_category order by sort_order desc limit 6";
        $query = $this->db->query($sql);
        return $query->rows;
    }
}