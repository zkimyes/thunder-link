<?php
class ModelAccountReview extends Model {
	public function getReviews($data = array()) {
		$sql = "SELECT r.review_id, pd.name,pt.image,r.text,r.author, r.rating, r.status, r.date_added FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product_description pd ON (r.product_id = pd.product_id)
		left join oc_product pt on pt.product_id = r.product_id 
		WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if(!empty($data['customer_id'])){
			$sql .= " AND r.customer_id = ". (int)$data['customer_id'];
		}

		$sort_data = array(
			'pd.name',
			'r.author',
			'r.rating',
			'r.status',
			'r.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY r.date_added";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

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

	public function getTotalReviews($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product_description pd ON (r.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_product'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_product']) . "%'";
		}

		if (!empty($data['filter_author'])) {
			$sql .= " AND r.author LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalReviewsAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review WHERE status = '0'");

		return $query->row['total'];
	}


	public function getReplyByReviewId($review_id=0){
		$query = $this->db->query("select * from oc_review_reply where review_id =".(int)$review_id." limit 1");
		return $query->rows;
	}

	public function addReply($data = []){
		if(!empty($data)){
			$sql = "insert into oc_review_reply (`review_id`,`content`,`author`,`product_id`) values 
				(
					".(int)$data['review_id'].",
					'".$this->db->escape($data['content'])."',
					'".$this->db->escape($data['author'])."',
					".(int)$data['product_id']."
				)";

			$query = $this->db->query($sql);
			return $query->row;
		}
		return false;
	}
}