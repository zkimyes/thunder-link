<?php
class ControllerProductAllCategory extends Controller {
	public function index() {
		$this->load->language('product/category');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		$this->document->addLink('/catalog/view/theme/default/stylesheet/all_category.css','stylesheet');

		$this->document->setTitle("All Categories");
		$this->document->setDescription("asdasdasdasasdasd");
		$this->document->setKeywords("adasdasd");

		$data['breadcrumbs'] = array();
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['heading_title'] = 'All Categories';
		$data['all_category'] = $this->model_catalog_category->getCategories();
		foreach($data['all_category'] as & $category){
			$category['child_category'] = $this->model_catalog_category->getCategories($category['category_id']);
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('product/all_category', $data));
	}
}
