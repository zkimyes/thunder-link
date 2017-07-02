<?php
require_once(DIR_APPLICATION.'/model/model_setting.php');
class SolutionCategory extends ActiveRecord {
    public $table = 'oc_solution_category';
	public $primaryKey = 'id';
}