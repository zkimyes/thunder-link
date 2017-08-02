<?php 
/**
 * configruration 目录
 */
class ModelConfigurationCategory extends Model{
    public function getList(){
        $sql = '';
        $sql = 'select category_id,name,image from oc_config_category';
        $category = $this->db->query($sql);
        return $category->rows;
    }
}