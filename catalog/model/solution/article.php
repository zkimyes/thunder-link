<?php
class ModelSolutionArticle extends Model {

    public function getList($ids="",$field=[],$order=""){
        $sql = "select";
        if(!empty($ids)){
            $sql .= " * from oc_solution_article as a where category_id in (".$ids.") order by category_id";
        }
        $artilces = $this->db->query($sql);
        return $artilces->rows;
    }
}