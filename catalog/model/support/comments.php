<?php
/**
 * support 评论
 */
class ModelSupportComments extends Model {
    public function getCommentsByArticleId($article_id){
        $sql = "select * from oc_support_comments where article_id =".(int)$article_id;
        $query = $this->db->query($sql);
        return $query->rows;
    }
}