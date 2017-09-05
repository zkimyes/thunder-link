<?php
class ModelSolutionCategory extends Model {
    
    public function getList($condition=[],$field=[],$order=""){
        $results = $this->db->query('
        select * from oc_solution_category as c
        left join oc_solution_article as a on c.id = a.category_id
        group by c.id
        ');
        return $results->rows;
    }
    
    
    public function getCategoris($condition=[],$field=[],$order=""){
        $results = $this->db->query('
            select * from oc_solution_category
        ');
        return $results->rows;
    }
    
}