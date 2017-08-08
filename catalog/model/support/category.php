<?php
class ModelSupportCategory extends Model {

    public function getList($condition="",$field="",$order=""){
        $sql = "select ";

        if(!empty($field)){
            $sql .=$field." ";
        }else{
            $sql .="* ";
        }

        $sql .="from oc_support_category";

        if(!empty($condition)){
            $sql .=" where ".$condition;
        }

        if(!empty($order)){
            $sql .=" order by ".$order;
        }

        $categorys = $this->db->query($sql);
        return $categorys->rows;
    }

    public function find($id=''){
        $category = $this->db->query("select * from oc_support_category where id =".intval($id));
        return $category->row;
    }

}