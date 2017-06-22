<?php
require_once('base_model.php');
/**
 * hot sale 目录
 */
class HotSaleCategory extends base {
    static $table_name = 'oc_hot_sale_category';


    public function getProducts(){
        include_once('hot_sale_products_model.php');
        $category = $this->find('all');
        $products = new HotSaleProducts();
        foreach($category as $item){
            $item->children = $products->find('all');
        }
        var_dump($category);
    }
}