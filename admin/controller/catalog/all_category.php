<?php
class ControllerCatalogAllCategory extends Controller {
    private $error = array();
    
    public function index() {
		$this->load->language('catalog/category');
		$this->load->model('catalog/category');
        $data['breadcrumbs'] = array();
        
        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );
        
        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('heading_title'),
        'href' => $this->url->link('catalog/all_category', 'token=' . $this->session->data['token'], true)
        );
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $data['product_search_url'] = $this->url->link('configuration/typical/getProduct');
        $data['banner_search_url'] = $this->url->link('catalog/all_category/getBanners');
        $data['token'] = $this->session->data['token'];
		
		$data['categories'] = $this->model_catalog_category->getAllCategorySetting();

        $this->document->setTitle($this->language->get('heading_title'));
        $this->response->setOutput($this->load->view('catalog/all_category_setting', $data));
    }

    public function edit(){
        $this->document->setTitle($this->language->get('heading_title'));
        $this->response->setOutput($this->load->view('catalog/all_category_setting_form', $data));
    }


    public function getBanners(){
        if(isset($this->request->get['name'])){
            $name = $this->request->get['name'];
        }else{
            $name = '';
        }

        $this->response->jsonOutput([
            'msg'=>'asdasd'
        ]);
    }
}