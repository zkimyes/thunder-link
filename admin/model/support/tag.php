<?php
class ModelSupportTag extends Model {

    public function getList($condition=[],$field=[],$order=""){
        $artilces = $this->db->query('
            select * from oc_support_tags limit 0,20;
        ');
        return $artilces->rows;
    }

    public function add($data = []){
        if(!empty($data)){
            $rs = $this->db->query("
                insert into oc_support_tags (
                    name
                ) values
                (
                    '".$this->db->escape($data['name'])."'
                )
            ");
            return $rs;
        }
        return false;
    }


    public function find($id=''){
        $article = $this->db->query("select * from oc_support_tags where id =".intval($id));
        return $article->row;
    }



    public function update($data = []){
        $rs = $this->db->query("
                update oc_support_tags set
                name='".$this->db->escape($data['name'])."'
                where id=".intval($data['id'])."
             ");
        return $rs;
    }

    public function delt($id=[]){
        if(count($id)>0){
            $id = join(',',$id);
            $rs = $this->db->query("delete from oc_support_tags where id in (".$id.")");
            return $rs;
        }
        return false;
    }


    public function findByName($name=''){
        if(!empty($name)){
            $rs = $this->db->query("
                select * from oc_support_tags where `name` like '%".$this->db->escape($name)."%' limit 5;
            ");
            return $rs->rows;
        }
        return null;
    }
}