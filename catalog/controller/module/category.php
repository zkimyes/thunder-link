<?php
class ControllerModuleCategory extends Controller {
	public function index() {
		$this->load->language('module/category');

		$data['heading_title'] = $this->language->get('heading_title');

		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['category_id'] = $parts[0];
		} else {
			$data['category_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$data['top_category'] = $this->model_catalog_category->getCategory($data['category_id']);
		$categories = $this->model_catalog_category->getCategories($data['category_id']);

		foreach ($categories as $category) {
			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'],
				'href'        => $this->url->link('product/category', 'path='.$data['category_id'].'_'. $category['category_id'])
			);
		}

		if(isset($this->request->get['path']) && !empty($this->request->get['path'])){
			$path = $this->request->get['path'];
		}else{
			$path = 0;
		}


		return $this->load->view('module/category', $data);
	}
}