<?php
class ModelSupportCategory extends Model {

    public function getList($condition=[],$field=[],$order=""){
        $categorys = $this->db->query('select * from oc_support_category');
        return $categorys->rows;
    }

    public function add($data = []){
        $rs = $this->db->query("
            insert into oc_support_category 
            (
                title,meta_keyword,meta_desc,url,parent_id
            ) 
            values
            (
                '".$this->db->escape($data['title'])."',
                '".$this->db->escape($data['meta_keyword'])."',
                '".$this->db->escape($data['meta_desc'])."',
                '".$this->db->escape($data['url'])."',
                ".(int)$data['parent_id']."
            )
        ");
        return $rs;
    }


    public function find($id=''){
        $category = $this->db->query("select * from oc_support_category where id =".intval($id));
        return $category->row;
    }


    public function update($data = []){
        $rs = $this->db->query("
                update oc_support_category set title='".$this->db->escape($data['title'])."',
                meta_keyword='".$this->db->escape($data['meta_keyword'])."',
                meta_desc='".$this->db->escape($data['meta_desc'])."',
                url='".$this->db->escape($data['url'])."',
                parent_id=".(int)$data['parent_id']."
                where id='".intval($data['id'])."'
             ");
        return $rs;
    }

    public function delt($id=[]){
        if(count($id)>0){
            $id = join(',',$id);
            $rs = $this->db->query("delete from oc_support_category where id in (".$id.")");
            return $rs;
        }
        return false;
    }

    /**
     * 获取跟当前目录没有关联的目录
     *
     * @return void
     */
    public function getNoneRelateCategories($id){
        if(!empty($id)){
            $sql = "select * from oc_support_category where id !=".$id." and parent_id !=".$id;
        }else{
            $sql = "select * from oc_support_category";
        }
        $result = $this->db->query($sql);
        return $result->rows;
    }


    public function makeTree($array,$pid=0,$parent_title=""){
        return $array;
    }

}