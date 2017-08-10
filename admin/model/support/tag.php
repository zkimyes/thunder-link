<?php
class ModelSupportTag extends Model {
    protected $table = 'oc_support_tags';
    
    public function getList($condition=[],$field=[],$order="",$page=1){
        if($page<0){
            $page = 1;
        }
        $sql = "select * from oc_support_tags ";
        $sql .="limit ".((int)($page - 1) * 12).",12";
        $artilces = $this->db->query($sql);
        return $artilces->rows;
    }
    
    public function getTotalTags(){
        $count = $this->db->query("select count(*) as total from oc_support_tags");
        return $count->row['total'];
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
    
    /**
    * 设置是否是热搜词
    *
    * @param [type] $id
    */
    public function setIsHot($selected){
        if(!empty($selected) && is_array($selected)){
            $sql = "update ".$this->table." set ";
            $ids = [];
            $sub_sql1 = 'is_hot= CASE id ';
            $sub_sql2 = 'hot_level=CASE id ';
            foreach($selected as $k=>$select){
                $sub_sql1 .= sprintf("WHEN %d THEN %d ", $select['id'], $select['checked']);
                $sub_sql2 .= sprintf("WHEN %d THEN %d ", $select['id'], $select['level']);
                $ids[$k] = $select['id'];
            }

            $sql .= $sub_sql1." END, ".$sub_sql2." END where id in (".join(',',$ids).")";
            $rs = $this->db->query($sql);
            return $sql;
        }else{
            return false;
        }
    }
    
    /**
    * 设置是否是推荐搜索
    *
    * @param [array] $selected
    */
    public function setIsSearch($selected){
        if(!empty($selected) && is_array($selected)){
            $sql = "update ".$this->table." set is_hot= CASE id ";
            $ids = [];
            foreach($selected as $k=>$select){
                $sql .= sprintf("WHEN %d THEN %d ", $select['id'], $select['checked']);
                $ids[$k] = $select['id'];
            }
            $sql .=" END where id in (".join(',',$ids).")";
            $rs = $this->db->query($sql);
            return $rs;
        }else{
            return false;
        }
    }
}