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

    public function addComments($data){
        $sql = "insert into oc_support_comments (`article_id`,`content`,`arthor`,`custom_id`)";
        $sql .=" values (
            ".(int)$data['article_id'].",
            '".$this->db->escape($data['content'])."',
            '".$this->db->escape($data['arthor'])."',
            ".(int)$data['custom_id']."
        )";
        $query = $this->db->query($sql);
        return $query->row;
    }
}