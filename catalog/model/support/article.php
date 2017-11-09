<?php
class ModelSupportArticle extends Model {
    
    public function searchByText($text=""){
        $sql = "SELECT a.id,a.title,a.summary,a.image,group_concat(t.name) as tags,(SELECT count(*) from oc_support_comments where article_id = a.id) as comments from oc_support_article a left join oc_support_tag_relative as r on a.id = r.support_id left JOIN oc_support_tags as t on t.id = r.tag_id WHERE a.title LIKE '%".$this->db->escape($text)."%'
        OR a.id in (SELECT support_id FROM oc_support_tag_relative WHERE tag_id in (SELECT id FROM oc_support_tags WHERE `name` = '".$this->db->escape($text)."')) GROUP BY id";
        if(!empty($text)){
            $rs = $this->db->query($sql);
            return $rs->rows;
        }else{
            return null;
        }
    }
    
    
    public function getArticleByCategoryId($category_id=0){
        $category = $this->db->query("SELECT id,parent_id from oc_support_category where id=".(int)$category_id);
        $category = $category->row;
        if(!empty($category )){
            if($category['parent_id'] == 0){
                $sql = "SELECT a.id,a.title,a.summary,a.image,group_concat(t.name) as tags from oc_support_article a left join oc_support_tag_relative r on a.id = r.support_id left JOIN oc_support_tags t on t.id = r.tag_id where a.category_id in (select id from oc_support_category where parent_id=".(int)$category_id.") GROUP BY a.id";
            }else{
                $sql = "SELECT a.id,a.title,a.summary,a.image,group_concat(t.name) as tags from oc_support_article a left join oc_support_tag_relative r on a.id = r.support_id left JOIN oc_support_tags t on t.id = r.tag_id where a.category_id=".(int)$category_id." GROUP BY a.id";
            }
            $rs = $this->db->query($sql);
            return $rs->rows;
        }else{
            return false;
        }
        
    }


    /**
     * 获取搜索条下的热关键词
     *
     * @return void
     */
    public function getIsSeachTags($limit=10){
        $tags = $this->db->query('select * from oc_support_tags where is_search=1 limit '.$limit);
        return $tags->rows;
    }
    
    /**
     * 获取目录页面的热关键词
     *
     * @return void
     */
    public function getIsHotTags(){
        $tags = $this->db->query('select * from oc_support_tags where is_hot=1');
        return $tags->rows;
    }
    
    public function viewArticle($id,$user_info){
        if($id){
            $article = $this->db->query("select * from oc_support_article where id =".(int)$id);
            return $article->row;
        }
    }


    public function getHomeArticleList(){
        $query = $this->db->query("select * from oc_support_article where is_home =1 limit 3");
        return $query->rows;
    }
    
}