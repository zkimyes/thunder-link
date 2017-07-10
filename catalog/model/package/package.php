<?php
class ModelPackagePackage extends Model {


	public function getPackages() {
		$sql = "SELECT * FROM " . DB_PREFIX . "package";

		if (isset($data['start']) || isset($data['limit'])) {

			$sql .= " ORDER BY `sort_order` DESC";
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}


}