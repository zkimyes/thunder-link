<?php
class ModelSupportArticle extends Model {

    public function getList($condition=[],$field=[],$order=""){
        $artilces = $this->db->query('
            select * from oc_support_article
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
            foreach($data['tag_ids'] as $tag_id){
                $sql .="(".intval($tag_id).",".intval($support_id)."),";
            }
            $this->db->query($sql);
            return $rs;
        }
        return false;
    }


    public function find($id=''){
        $article = $this->db->query("select * from oc_support_article where id =".intval($id));
        return $article->row;
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