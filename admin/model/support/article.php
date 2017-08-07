<?php
class ModelSupportArticle extends Model {
    
    public function getList($condition=[],$field=[],$order=""){
        $artilces = $this->db->query('
        select a.id,a.title,a.createAt,a.image,c.title as category_name from oc_support_article as a left join oc_support_category as c on c.id = a.category_id
        ');
        return $artilces->rows;
    }
    
    public function add($data = []){
        if(!empty($data)){
            $this->db->query("
            insert into oc_support_article (
            title,category_id,meta_title,meta_keywords,meta_desc,summary,content,image,banner_id,related_product_ids,createAt
            ) values
            (
            '".$this->db->escape($data['title'])."',
            ".intval($data['category_id']).",
            '".$this->db->escape($data['title'])."',
            '".$this->db->escape($data['meta_keywords'])."',
            '".$this->db->escape($data['meta_desc'])."',
            '".$this->db->escape($data['summary'])."',
            '".$this->db->escape($data['content'])."',
            '".$this->db->escape($data['image'])."',
            ".intval($data['banner_id']).",
            '".$this->db->escape($data['related_product_ids'])."',
            '".date('Y-m-d H:i:s')."'
            )
            ");
            $support_id = $this->db->getLastId();
            $sql = "insert into oc_support_tag_relative (support_id,tag_id)";
            $values = [];
            foreach($data['tag_ids'] as $tag_id){
                $values[] ="(".intval($support_id).",".intval($tag_id).")";
            }
            $sql = $sql.' '.join(',',$values);
            $this->db->query($sql);
            return $rs;
        }
        return false;
    }
    
    
    public function find($id=''){
        $article = $this->db->query("select * from oc_support_article where id =".intval($id));
        return $article->row;
    }
    
    
    /**
    * 获取关联的tag标签
    *
    * @return void
    */
    public function getRelateTagsById($id=""){
        $sql = "select t.* from oc_support_tag_relative as r left join oc_support_tags as t on t.id = r.tag_id where r.support_id =".intval($id);
        $rs = $this->db->query($sql);
        return $rs->rows;
    }
    
    
    public function update($data = []){
        $rs = $this->db->query("
        update oc_support_article set
        title='".$this->db->escape($data['title'])."',
        category_id = ".intval($data['category_id']).",
        meta_title='".$this->db->escape($data['title'])."',
        meta_keywords='".$this->db->escape($data['meta_keywords'])."',
        meta_desc='".$this->db->escape($data['meta_desc'])."',
        summary='".$this->db->escape($data['summary'])."',
        content = '".$this->db->escape($data['content'])."',
        image = '".$this->db->escape($data['image'])."',
        banner_id = ".intval($data['banner_id']).",
        related_product_ids='".$this->db->escape($data['related_product_ids'])."'
        where id=".intval($data['id'])."
        ");
        $this->db->query("delte")
        $sql = "insert into oc_support_tag_relative (support_id,tag_id) values";
        $values = [];
        foreach($data['tag_ids'] as $tag_id){
            $values[] ="(".intval($data['id']).",".intval($tag_id).")";
        }
        $sql = $sql.' '.join(',',$values);
        $this->db->query($sql);
        return $rs;
    }
    
    public function delt($id=[]){
        if(count($id)>0){
            $id = join(',',$id);
            $rs = $this->db->query("delete from oc_support_article where id in (".$id.")");
            return $rs;
        }
        return false;
    }
}