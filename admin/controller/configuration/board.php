<?php
// board

class ControllerConfigurationBoard extends Controller{
    public function index(){
        $this->document->setTitle('Configuration Board');
        $this->getList();
    }
    
    public function delete(){
        $this->load->model('configuration/board');
        if (isset($this->request->post['selected'])) {
            $this->model_configuration_board->delt($this->request->post['selected']);
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
        $this->load->model('configuration/board');
        $url = '';
        $data['submit_url'] = $this->url->link('configuration/board/add');
        $data['breadcrumbs'] = [];
        
        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );
        
        $data['breadcrumbs'][] = array(
        'text' => 'Configuration Board Add',
        'href' => $this->url->link('configuration/board/add', 'token=' . $this->session->data['token'] . $url, true)
        );
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_configuration_board->add($post);
            $this->response->jsonOutput($rs);
        }else{
            $this->form($data);
        };
    }
    
    public function update(){
        $this->load->model('configuration/board');
        $url = '';
        $data['breadcrumbs'] = [];
        
        $data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );
        
        $data['breadcrumbs'][] = array(
        'text' => 'Configuration Board Update',
        'href' => $this->url->link('configuration/board/update', 'token=' . $this->session->data['token'] . $url, true)
        );
        $data['submit_url'] = $this->url->link('configuration/board/update');
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_configuration_board->update($post);
            $this->response->jsonOutput($rs);
        }else{
            $id = $this->request->get['id'];
            if(!empty($id)){
                $board = $this->model_configuration_board->find($id);
            }
            $data['board'] = $board;
            $this->form($data);
        };
    }
    
    
    protected function form($data){
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $data['back_url'] = $this->url->link('configuration/board/index');
        $data['token'] = $this->session->data['token'];
        $this->load->model('configuration/board_type');
        $data['board_types'] = json_encode($this->model_configuration_board_type->getList());
        $this->response->setOutput($this->load->view('configuration/board_form', $data));
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
        'text' => 'Configuration Board',
        'href' => $this->url->link('configuration/board', 'token=' . $this->session->data['token'] . $url, true)
        );
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $data['add_url'] = $this->url->link('configuration/board/add');
        $data['update_url'] = $this->url->link('configuration/board/update');
        $data['delt_url'] = $this->url->link('configuration/board/delete');
        
        $this->load->model('configuration/board');
        $boards = $this->model_configuration_board->getList();
        
        $data['lists'] = json_encode($boards);
        $data['token'] = $token;
        $this->response->setOutput($this->load->view('configuration/board_list', $data));
    }
}