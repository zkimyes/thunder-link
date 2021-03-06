<?php
/**
* solution 的目录
* Undocumented class
*/
class ControllerSolutionCategory extends Controller{
    
    public function index(){
        $this->load->language('sale/order');
        
        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('sale/order');
        
        $this->getList();
    }
    
    public function delete(){
        $this->load->model('solution/category');
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
        $data['breadcrumbs'][] = [
        'text'=>'Home',
        'href'=>$this->url->link('commom/dashboard','token='.$this->session->data['token'])
        ];
        $data['breadcrumbs'][] = [
        'text'=>'Solution Category Add',
        'href'=>$this->url->link('solution/category/add','token='.$this->session->data['token'])
        ];
        $data['submit_url'] = $this->url->link('solution/category/add');
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_solution_category->add($post);
            $this->response->jsonOutput($rs);
        }else{
            $this->form($data);
        };
    }
    
    public function update(){
        $this->load->model('solution/category');
        $data['breadcrumbs'][] = [
        'text'=>'Home',
        'href'=>$this->url->link('commom/dashboard','token='.$this->session->data['token'])
        ];
        $data['breadcrumbs'][] = [
        'text'=>'Solution Category Update',
        'href'=>$this->url->link('solution/category/update','id='.$this->request->get['id'].'&token='.$this->session->data['token'])
        ];
        $data['submit_url'] = $this->url->link('solution/category/update');
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_solution_category->update($post);
            $this->response->jsonOutput($rs);
        }else{
            $id = $this->request->get['id'];
            if(!empty($id)){
                $category = $this->model_solution_category->find($id);
            }
            $data['category'] = $category;
            $this->form($data);
        };
    }
    
    
    protected function form($data){
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $data['back_url'] = $this->url->link('solution/category/index');
        $data['token'] = $this->session->data['token'];
        $this->response->setOutput($this->load->view('solution/category_form', $data));
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
        'text' => 'Solution Category',
        'href' => $this->url->link('solution/category', 'token=' . $this->session->data['token'] . $url, true)
        );
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $data['add_url'] = $this->url->link('solution/category/add');
        $data['update_url'] = $this->url->link('solution/category/update');
        $data['delt_url'] = $this->url->link('solution/category/delete');
        
        $this->load->model('solution/category');
        $categorys = $this->model_solution_category->getList();
        
        $data['lists'] = json_encode($categorys);
        
        $data['token'] = $token;
        $this->response->setOutput($this->load->view('solution/category_list', $data));
    }
}