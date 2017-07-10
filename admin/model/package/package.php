<?php
class ModelPackagePackage extends Model {
	public function addPackage($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "package SET title = '" . $this->db->escape($data['title']) . "', description = '" . $this->db->escape($data['description']) . "', detail = '" . $this->db->escape($data['detail']) . "', main_product = '" . $this->db->escape($data['main_product']) . "', sort_order = " . (int)$data['sort_order'] . ",config_category=".$data['config_category']);

		$package_id = $this->db->getLastId();

		return $package_id;
	}

	public function editPackage($package_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "package SET title = '" . $this->db->escape($data['title']) . "', description = '" . $this->db->escape($data['description']) . "', detail = '" . $this->db->escape($data['detail']) . "', main_product = '" . $this->db->escape($data['main_product']) . "', sort_order = " . (int)$data['sort_order'] . ",config_category=".$data['config_category']." WHERE package_id = ".(int)$package_id);

	}

	public function deletePackage($package_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "package WHERE package_id = '" . (int)$package_id . "'");
	}

	public function getPackage($package_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "package WHERE package_id = '" . (int)$package_id . "'");

		return $query->row;
	}

	public function getPackages($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "package WHERE package_id";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotal() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "package");

		return $query->row['total'];
	}

}