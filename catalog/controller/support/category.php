<?php
class ControllerSupportCategory extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = null;
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');


		$this->load->model('support/category');
		$categories = $this->model_support_category->getList('',"id,title,parent_id");
		$parents = [];
		$childs = [];

		foreach($categories as $category){
			if($category['parent_id'] == 0){
				$parents[] = $category;
			}else{
				$childs[] = $category;
			}
		}

		foreach($parents as &$parent){
			foreach($childs as $child){
				if($parent['id'] == $child['parent_id']){
					$parent['child'][] = $child;
				}
			}
		}


		$data['sider_categories'] = $parents;

		$this->response->setOutput($this->load->view('support/index', $data));
	}
}