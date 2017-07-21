<?php
// config 目录

class ControllerConfigurationCategory extends Controller{
    public function index(){
        $this->document->setTitle('Configuration Category');
        $this->getList();
    }
    
    public function delete(){
        $this->load->model('configuration/category');
        if (isset($this->request->post['selected'])) {
            $this->model_solution_category->delt($this->request->post['selected']);
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
        $this->load->model('solution/category');
        $url = '';
        $data['submit_url'] = $this->url->link('configuration/category/add');
        $data['breadcrumbs'] = [];
        
        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );
        
        $data['breadcrumbs'][] = array(
        'text' => 'Configuration Category',
        'href' => $this->url->link('configuration/category', 'token=' . $this->session->data['token'] . $url, true)
        );
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_solution_category->add($post);
            $this->response->jsonOutput($rs);
        }else{
            $this->form($data);
        };
    }
    
    public function update(){
        $this->load->model('configuration/category');
        $url = '';
        $data['breadcrumbs'] = [];
        
        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );
        
        $data['breadcrumbs'][] = array(
        'text' => 'Configuration Category',
        'href' => $this->url->link('configuration/category', 'token=' . $this->session->data['token'] . $url, true)
        );
        $data['submit_url'] = $this->url->link('configuration/category/update');
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_configuration_category->update($post);
            $this->response->jsonOutput($rs);
        }else{
            $id = $this->request->get['id'];
            if(!empty($id)){
                $category = $this->model_configuration_category->find($id);
            }
            $data['category'] = $category;
            $this->form($data);
        };
    }
    
    
    protected function form($data){
        $this->load->model('design/banner');
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $data['back_url'] = $this->url->link('configuration/category/index');
        $data['token'] = $this->session->data['token'];
        if (!empty($data['category']['image']) && is_file(DIR_IMAGE . $data['category']['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($data['category']['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
        $data['banners'] = $this->model_design_banner->getBanners();

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        $this->response->setOutput($this->load->view('configuration/category_form', $data));
    }
    
    
    protected function getList() {
        $token = $this->session->data['token'];
        $url = "";
        $data['url'] = $this->url;
        $data['breadcrumbs'] = [];
        
        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );
        
        $data['breadcrumbs'][] = array(
        'text' => 'Configuration Category',
        'href' => $this->url->link('configuration/category', 'token=' . $this->session->data['token'] . $url, true)
        );
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $data['add_url'] = $this->url->link('configuration/category/add');
        $data['update_url'] = $this->url->link('configuration/category/update');
        $data['delt_url'] = $this->url->link('configuration/category/delete');
        
        $this->load->model('configuration/category');
        $this->load->model('tool/image');
        $categorys = $this->model_configuration_category->getList();
        
        $data['lists'] = [];
        foreach($categorys as &$category){
            if (!empty($category['image']) && is_file(DIR_IMAGE . $category['image'])) {
                $category['thumb'] = $this->model_tool_image->resize($category['image'], 50, 50);
            } else {
                $category['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
            }
            $data['lists'][] = $category;
        }
        
        $data['lists'] = json_encode($data['lists']);
        $data['token'] = $token;
        $this->response->setOutput($this->load->view('configuration/category_list', $data));
    }
}