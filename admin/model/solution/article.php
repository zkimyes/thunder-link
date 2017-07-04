<?php
class ModelSolutionArticle extends Model {

    public function getList($condition=[],$field=[],$order=""){
        $artilces = $this->db->query('
            select a.title,a.id,a.createAt,c.title as category_name from oc_solution_article as a left join oc_solution_category as c
            on c.id = a.category_id;
        ');
        return $artilces->rows;
    }

    public function add($data = []){
        $keys = join(',',array_keys($data));
        $values = join(',',array_values($data));
        $rs = $this->db->query("
            insert into oc_solution_article (".$keys.") values
             (".$values.")
        ");
        return $rs;
    }


    public function find($id=''){
        $category = $this->db->query("select * from oc_solution_category where id =".intval($id));
        return $category->row;
    }


    public function update($data = []){
        $rs = $this->db->query("
                update oc_solution_article set title='".$this->db->escape($data['title'])."',
                meta_keyword='".$this->db->escape($data['meta_keyword'])."',
                meta_desc='".$this->db->escape($data['meta_desc'])."',
                url='".$this->db->escape($data['url'])."' where id='".intval($data['id'])."'
             ");
        return $rs;
    }

    public function delt($id=[]){
        if(count($id)>0){
            $id = join(',',$id);
            $rs = $this->db->query("delete from oc_solution_article where id in (".$id.")");
            return $rs;
        }
        return false;
    }
}