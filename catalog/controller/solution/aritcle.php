<?php
class ControllerSolutionArticle extends Controller{
    public function index(){
        $this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		$this->document->addStyle('catalog/view/theme/default/stylesheet/solution.css');


		$this->load->model('solution/category');
		$this->load->model('solution/article');
		$data['solution_categoris'] = $this->model_solution_category->getCategoris();
		$category_ids = implode(',',array_map('returnCid',$data['solution_categoris']));
		$data['articles'] = $this->model_solution_article->getList($category_ids);

		$data['solution_category'] = $this->model_solution_category->getList();
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = null;
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('solution/index', $data));
    }
}