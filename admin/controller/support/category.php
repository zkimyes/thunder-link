<?php
/**
* 用户支持文章目录管理
* Undocumented class
*/
class ControllerSupportCategory extends Controller{
    
    public function index(){
        $this->document->setTitle('Support Category');
        
        $this->load->model('sale/order');
        
        $this->getList();
    }
    
    public function delete(){
        $this->load->model('support/category');
        if (isset($this->request->post['selected'])) {
            $this->model_support_category->delt($this->request->post['selected']);
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
        $this->document->setTitle('Support Category Add');
        $this->load->model('support/category');
        $data['breadcrumbs'][] = [
        'text'=>'Home',
        'href'=>$this->url->link('commom/dashboard','token='.$this->session->data['token'])
        ];
        $data['breadcrumbs'][] = [
        'text'=>'support Category Add',
        'href'=>$this->url->link('support/category/add','token='.$this->session->data['token'])
        ];
        $data['submit_url'] = $this->url->link('support/category/add');
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_support_category->add($post);
            $this->response->jsonOutput($rs);
        }else{
            $this->form($data);
        };
    }
    
    public function update(){
        $this->load->model('support/category');
        $data['submit_url'] = $this->url->link('support/category/update');
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_support_category->update($post);
            $this->response->jsonOutput($rs);
        }else{
            $data['breadcrumbs'][] = [
            'text'=>'Home',
            'href'=>$this->url->link('commom/dashboard','token='.$this->session->data['token'])
            ];
            $data['breadcrumbs'][] = [
            'text'=>'support Category Update',
            'href'=>$this->url->link('support/category/update','id='.$this->request->get['id'].'&token='.$this->session->data['token'])
            ];
            $id = $this->request->get['id'];
            if(!empty($id)){
                $data['category'] = $this->model_support_category->find($id);
            }
            $this->form($data);
        };
    }
    
    
    protected function form($data){
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $data['back_url'] = $this->url->link('support/category/index');
        $data['token'] = $this->session->data['token'];
        $data['categories'] = json_encode($this->model_support_category->getNoneRelateCategories(isset($data['category'])?$data['category']['id']:0));
        $this->response->setOutput($this->load->view('support/category_form', $data));
    }
    
    
    protected function getList() {
        $token = $this->session->data['token'];
        $url = "";
        $data['url'] = $this->url;
        $data['breadcrumbs'] = array();
        
        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );
        
        $data['breadcrumbs'][] = array(
        'text' => 'Support Category',
        'href' => $this->url->link('support/category/add', 'token=' . $this->session->data['token'] . $url, true)
        );
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $data['add_url'] = $this->url->link('support/category/add');
        $data['update_url'] = $this->url->link('support/category/update');
        $data['delt_url'] = $this->url->link('support/category/delete');
        
        $this->load->model('support/category');
        $categories = $this->model_support_category->getList();
        $categories = $this->model_support_category->makeTree($categories);
        $data['lists'] = json_encode($categories);
        
        $data['token'] = $token;
        $this->response->setOutput($this->load->view('support/category_list', $data));
    }
}