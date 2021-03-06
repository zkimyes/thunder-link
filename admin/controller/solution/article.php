<?php
/**
* 解决方案文章管理
*/
class ControllerSolutionArticle extends Controller{
    public function index(){
        $this->document->setTitle("Solution Article");
        
        $data['breadcrumbs'][] = [
        'text'=>'Home',
        'href'=>$this->url->link('commom/dashboard','token='.$this->session->data['token'])
        ];
        $data['breadcrumbs'][] = [
        'text'=>'Solution Article',
        'href'=>''
        ];
        
        $this->getList($data);
    }
    
    public function delete(){
        $this->load->model('solution/article');
        if (isset($this->request->post['selected'])) {
            $this->model_solution_article->delt($this->request->post['selected']);
            $this->response->jsonOutput([
            'status'=>'1',
            'info'=>'success'
            ]);
        }else{
            $this->response->jsonOutput([
            'status'=>'0',
            'info'=>'no item to delete'
            ]);
        }
    }
    
    
    public function add(){
        $this->load->model('solution/article');
        $data['submit_url'] = $this->url->link('solution/article/add');
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_solution_article->add($post);
            $this->response->jsonOutput($rs);
        }else{
            $data['breadcrumbs'][] = [
            'text'=>'Home',
            'href'=>$this->url->link('commom/dashboard','token='.$this->session->data['token'])
            ];
            $data['breadcrumbs'][] = [
            'text'=>'Solution Article Add',
            'href'=>'javascript:;'
            ];
            $data['product_relateds'] = [];
            $this->form($data);
        };
    }
    
    public function update(){
        $this->load->model('solution/article');
        $this->load->model('catalog/product');
        $data['submit_url'] = $this->url->link('solution/article/update');
        $data['breadcrumbs'][] = [
        'text'=>'Home',
        'href'=>$this->url->link('commom/dashboard','token='.$this->session->data['token'])
        ];
        $data['breadcrumbs'][] = [
        'text'=>'Solution Article Update',
        'href'=>''
        ];
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_solution_article->update($post);
            $this->response->jsonOutput($rs);
        }else{
            $id = $this->request->get['id'];
            if(!empty($id)){
                $article = $this->model_solution_article->find($id);
            }
            $data['article'] = $article;
            $data['product_relateds'] = [];
            if(!empty($article['related_product_ids'])){
                $related_info = $this->model_catalog_product->getProductsByProductIds($article['related_product_ids']);
                $data['product_relateds'] = $related_info;
            }
            $this->form($data);
        };
    }
    
    
    protected function form($data){
        $this->load->model('solution/category');
        $this->load->model('design/banner');
        $data['categorys'] = $this->model_solution_category->getList();
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $data['back_url'] = $this->url->link('solution/article/index');
        $data['token'] = $this->session->data['token'];
        if (!empty($data['article']['image']) && is_file(DIR_IMAGE . $data['article']['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($data['article']['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

        $data['banners'] = $this->model_design_banner->getBanners();

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


        $this->response->setOutput($this->load->view('solution/article_form', $data));
    }
    
    
    protected function getList($data) {
        $token = $this->session->data['token'];
        $data['url'] = $this->url;
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $data['add_url'] = $this->url->link('solution/article/add');
        $data['update_url'] = $this->url->link('solution/article/update');
        $data['delt_url'] = $this->url->link('solution/article/delete');
        
        $this->load->model('solution/article');
        $articles = $this->model_solution_article->getList();
        foreach($articles as $article){
            if (!empty($article['image']) && is_file(DIR_IMAGE . $article['image'])) {
                $article['thumb'] = $this->model_tool_image->resize($article['image'], 50, 50);
            } else {
                $article['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
            }
            $data['lists'][] = $article;
        }
        
        $data['token'] = $token;
        $this->response->setOutput($this->load->view('solution/article_list', $data));
    }
}