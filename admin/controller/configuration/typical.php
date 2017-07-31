<?php
// 典型配置

class ControllerConfigurationTypical extends Controller{
    public function index(){
        $this->document->setTitle('Configuration Typical');
        $this->getList();
    }
    
    public function delete(){
        $this->load->model('configuration/typical');
        if (isset($this->request->post['selected'])) {
            $this->model_configuration_typical->delt($this->request->post['selected']);
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
        $this->document->setTitle('Configuration Typical Add');
        $this->load->model('configuration/typical');
        $url = '';
        $data['submit_url'] = $this->url->link('configuration/typical/add');
        $data['breadcrumbs'] = [];
        
        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );
        
        $data['breadcrumbs'][] = array(
        'text' => 'Configuration Typical Add',
        'href' => $this->url->link('configuration/typical', 'token=' . $this->session->data['token'] . $url, true)
        );
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_configuration_typical->add($post);
            $this->response->jsonOutput($rs);
        }else{
            $this->form($data);
        };
    }
    
    public function update(){
        $this->document->setTitle('Configuration Typical Update');
        $this->load->model('configuration/typical');
        $url = '';
        $data['breadcrumbs'] = [];
        
        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );
        
        $data['breadcrumbs'][] = array(
        'text' => 'Configuration Category',
        'href' => $this->url->link('configuration/typical', 'token=' . $this->session->data['token'] . $url, true)
        );
        $data['submit_url'] = $this->url->link('configuration/typical/update');
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_configuration_typical->update($post);
            $this->response->jsonOutput($rs);
        }else{
            $id = $this->request->get['id'];
            if(!empty($id)){
                $typical = $this->model_configuration_typical->find($id);
            }
            $data['typical'] = $typical;
            $this->form($data);
        };
    }
    
    
    protected function form($data){
        $this->load->model('configuration/category');
        $this->load->model('configuration/board');
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $data['back_url'] = $this->url->link('configuration/typical/index');
        $data['token'] = $this->session->data['token'];
        $data['product_search_url'] = $this->url->link('configuration/typical/getProduct');
        if (!empty($data['typical']['image']) && is_file(DIR_IMAGE . $data['typical']['image'])) {
			$data['typical']['thumb'] = $this->model_tool_image->resize($data['typical']['image'], 100, 100);
		} else {
			$data['typical']['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
        if (!empty($data['typical']['blueprint']) && is_file(DIR_IMAGE . $data['typical']['blueprint'])) {
			$data['typical']['thumb_blueprint'] = $this->model_tool_image->resize($data['category']['image'], 100, 100);
		} else {
			$data['typical']['thumb_blueprint'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
        $data['categorys'] = $this->model_configuration_category->getList();
        $data['boards'] = json_encode($this->model_configuration_board->getList());
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        $this->response->setOutput($this->load->view('configuration/typical_form', $data));
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
        'text' => 'Configuration Typical',
        'href' => $this->url->link('configuration/typical', 'token=' . $this->session->data['token'] . $url, true)
        );
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $data['add_url'] = $this->url->link('configuration/typical/add');
        $data['update_url'] = $this->url->link('configuration/typical/update');
        $data['delt_url'] = $this->url->link('configuration/typical/delete');
        
        $this->load->model('configuration/typical');
        $this->load->model('tool/image');
        $typicals = $this->model_configuration_typical->getList();
        
        $data['lists'] = [];
        foreach($typicals as &$typical){
            if (!empty($typical['image']) && is_file(DIR_IMAGE . $typical['image'])) {
                $typical['thumb'] = $this->model_tool_image->resize($typical['image'], 50, 50);
            } else {
                $typical['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
            }
            if (!empty($typical['blueprint']) && is_file(DIR_IMAGE . $typical['blueprint'])) {
                $typical['thumb_blueprint'] = $this->model_tool_image->resize($typical['blueprint'], 50, 50);
            } else {
                $typical['thumb_blueprint'] = $this->model_tool_image->resize('no_image.png', 50, 50);
            }
            $data['lists'][] = $typical;
        }
        $data['lists'] = json_encode($data['lists']);
        $data['token'] = $token;
        $this->response->setOutput($this->load->view('configuration/typical_list', $data));
    }



    public function getProduct(){
        $this->load->model('catalog/product');
        $this->load->model('tool/image');
        $search = $this->request->get['search'];
        if($search == '@'){
            $result = $this->model_catalog_product->getProducts([
                'start'=>0,
                'limit'=>5
            ]);
        }else{
            $result = $this->model_catalog_product->getProducts([
                'filter_name'=>$search,
                'start'=>0,
                'limit'=>5
            ]);
        }
        foreach($result as &$product){
            if (!empty($product['image']) && is_file(DIR_IMAGE . $product['image'])) {
                $product['thumb'] = $this->model_tool_image->resize($product['image'], 100, 100);
            } else {
                $product['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
            }
        }
        
        $this->response->jsonOutput([
            'products'=>$result
        ]);
    }
}