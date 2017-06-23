<?php
/**
 * hot sale 目录
 */

class ModelHotSaleCategory extends Model{

    public function getHomeHotSale(){
        $data = [];
        $query = $this->db->query(
            'SELECT c.id,c.name,p.* from oc_hot_sale_category c,oc_hot_sale_products p where c.id = p.hot_sale_category_id'
        );
    }
}