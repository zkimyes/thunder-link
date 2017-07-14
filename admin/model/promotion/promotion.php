<?php
class ModelPromotionPromotion extends Model {
    private $limit = 15;
    private $table = DB_PREFIX . "promotion";
	public function getList($page) {
		$sql = "SELECT * FROM " . $this->table;

        $sql .=" left join ".DB_PREFIX."product_description on ".$this->table.".product_id ="
                .DB_PREFIX."product_description.product_id";

		// $sort_data = array(
		// 	'name',
		// 	'status'
		// );

		// if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
		// 	$sql .= " ORDER BY " . $data['sort'];
		// } else {
		// 	$sql .= " ORDER BY name";
		// }

		// if (isset($data['order']) && ($data['order'] == 'DESC')) {
		// 	$sql .= " DESC";
		// } else {
		// 	$sql .= " ASC";
		// }

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


    public function getTotal(){
        $sql = "select count(*) as count from " .$this->table;
        return $this->db->query($sql);
    }
}
