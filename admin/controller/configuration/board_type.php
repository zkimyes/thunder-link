<?php
// board type

class ControllerConfigurationBoardType extends Controller{
    public function index(){
        $this->document->setTitle('Configuration Board Type');
        $this->getList();
    }
    
    public function delete(){
        $this->load->model('configuration/board_type');
        if (isset($this->request->post['selected'])) {
            $this->model_configuration_category->delt($this->request->post['selected']);
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
        $this->load->model('configuration/board_type');
        $url = '';
        $data['submit_url'] = $this->url->link('configuration/board_type/add');
        $data['breadcrumbs'] = [];
        
        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );
        
        $data['breadcrumbs'][] = array(
        'text' => 'Configuration Board Type Add',
        'href' => $this->url->link('configuration/board_type', 'token=' . $this->session->data['token'] . $url, true)
        );
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_configuration_board_type->add($post);
            $this->response->jsonOutput($rs);
        }else{
            $this->form($data);
        };
    }
    
    public function update(){
        $this->load->model('configuration/board_type');
        $url = '';
        $data['breadcrumbs'] = [];
        
        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );
        
        $data['breadcrumbs'][] = array(
        'text' => 'Configuration Board Type Update',
        'href' => $this->url->link('configuration/board_type', 'token=' . $this->session->data['token'] . $url, true)
        );
        $data['submit_url'] = $this->url->link('configuration/board_type/update');
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_configuration_board_type->update($post);
            $this->response->jsonOutput($rs);
        }else{
            $id = $this->request->get['id'];
            if(!empty($id)){
                $board_type = $this->model_configuration_board_type->find($id);
            }
            $data['board_type'] = $board_type;
            $this->form($data);
        };
    }
    
    
    protected function form($data){
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $data['back_url'] = $this->url->link('configuration/board_type');
        $data['token'] = $this->session->data['token'];
        $this->response->setOutput($this->load->view('configuration/board_type_form', $data));
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
        'text' => 'Configuration Board Type',
        'href' => $this->url->link('configuration/board_type', 'token=' . $this->session->data['token'] . $url, true)
        );
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $data['add_url'] = $this->url->link('configuration/board_type/add');
        $data['update_url'] = $this->url->link('configuration/board_type/update');
        $data['delt_url'] = $this->url->link('configuration/board_type/delete');
        
        $this->load->model('configuration/board_type');
        $this->load->model('tool/image');
        $types = $this->model_configuration_board_type->getList();
        $data['lists'] = json_encode($types);
        $data['token'] = $token;
        $this->response->setOutput($this->load->view('configuration/board_type_list', $data));
    }
}