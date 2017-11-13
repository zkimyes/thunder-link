<?php
class ControllerSolutionArticle extends Controller{
    public function index(){
        $this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		$this->document->addStyle('catalog/view/theme/default/stylesheet/solution.css');
		$this->load->model('solution/article');
		$this->load->model('catalog/product');
		if(!empty($this->request->get['id'])){
			$data['article'] = $this->model_solution_article->find(intval($this->request->get['id']));
			if(empty($data['article'])){
				$this->emptyPage();
			}
			$data['article']['content'] = htmlspecialchars_decode($data['article']['content']);
			$data['article']['main_content'] = htmlspecialchars_decode($data['article']['main_content']);
			$data['related_products'] = $data['article']['related_product_ids'] != ''?$this->model_catalog_product->getProductsByProductIds($data['article']['related_product_ids']):null;
		}else{
			$this->emptyPage();
		}
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = null;
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('solution/article', $data));
    }
}
