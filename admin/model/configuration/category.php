<?php
class ModelConfigurationCategory extends Model {

    public function getList($condition=[],$field=[],$order=""){
        $categorys = $this->db->query('select category_id,`name`,image,sort_order,banner from oc_config_category');
        return $categorys->rows;
    }

    public function add($data = []){
        $keys = join(',',array_keys($data));
        $values = join(',',array_values($data));
        $rs = $this->db->query("
            insert into oc_solution_category 
            (
                title,meta_keyword,meta_desc,url
            ) 
            values
            (
                '".$this->db->escape($data['title'])."',
                '".$this->db->escape($data['meta_keyword'])."',
                '".$this->db->escape($data['meta_desc'])."',
                '".$this->db->escape($data['url'])."'
            )
        ");
        return $rs;
    }


    public function find($id=''){
        $category = $this->db->query("select * from oc_config_category where category_id =".intval($id));
        return $category->row;
    }


    public function update($data = []){
        $rs = $this->db->query("
                update oc_solution_category set `name`='".$this->db->escape($data['name'])."',
                meta_title='".$this->db->escape($data['meta_title'])."',
                meta_description='".$this->db->escape($data['meta_description'])."',
                meta_keyword='".$this->db->escape($data['meta_keyword'])."',
                image='".$this->db->esacpe($data['image'])."',
                sort_order=".intval($data['sort_order']).",
                banner=".intval($data['banner'])."
                 where category_id='".intval($data['category_id'])."'
             ");
        return $rs;
    }

    public function delt($id=[]){
        if(count($id)>0){
            $id = join(',',$id);
            $rs = $this->db->query("delete from oc_solution_category where id in (".$id.")");
            return $rs;
        }
        return false;
    }
}