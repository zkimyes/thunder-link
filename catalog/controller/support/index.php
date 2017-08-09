<?php
class ControllerSupportIndex extends Controller {
    public function index() {
        $this->document->setTitle($this->config->get('config_meta_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->setKeywords($this->config->get('config_meta_keyword'));
		$this->document->addLink('https://cdn.bootcss.com/loaders.css/0.1.2/loaders.min.css','stylesheet');
        $this->document->addScript("/catalog/view/javascript/app/support.js");
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = null;
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

		$data['search_action'] = $this->url->link('support/index');
        
        
        $this->load->model('support/category');
        $this->load->model('support/article');
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
            $parent['url'] = $this->url->link('support/category','id='.$parent['id']);
            foreach($childs as $child){
                if($parent['id'] == $child['parent_id']){
                    $parent['child'][] = $child;
                }
            }
        }
        
        
        $data['sider_categories'] = $parents;
        
        
        if(isset($this->request->get['search']) && !empty($this->request->get['search'])){
            $search = $this->request->get['search'];
        }else{
            $search = "";
        }
        $data['search'] = strip_tags(htmlentities($search));

        if(!empty($data['search'])){
            $result = $this->model_support_article->searchByText($data['search']);
            var_dump($result);
        }

        $this->response->setOutput($this->load->view('support/index', $data));
    }
}