<?php
class ControllerHotSaleIndex extends Controller {
	private $error = array();
    
    public function index(){
        $this->document->addScript('/admin/view/javascript/vue/vue.min.js');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


        $data['getList_url'] = $this->url->link('hotsale/index/getList','token=' . $this->session->data['token'],true);
        $data['delt_url'] = $this->url->link('hotsale/index/delt','token=' . $this->session->data['token'],true);
        $data['update_url'] = $this->url->link('hotsale/index/edit','token=' . $this->session->data['token'],true);
        $data['add_url'] = $this->url->link('hotsale/index/add','token=' . $this->session->data['token'],true);
        $this->response->setOutput($this->load->view('hotsale/index', $data));
    } 

    public function form($data){
        $this->document->addScript('/admin/view/javascript/vue/vue.min.js');
        $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

        $data['backurl'] = $this->url->link('hotsale/index','token=' . $this->session->data['token'],true);
 		$this->response->setOutput($this->load->view('hotsale/form', $data));
    }


    public function add(){
        $data['action'] = 'Add';
        $data['post_url'] = $this->url->link('hotsale/index/add_data','token=' . $this->session->data['token'],true);
        $this->form($data);
    }

    public function edit(){
        $data['action'] = 'Update';
        $id = $this->request->get['id'];
        $this->load->model('hotsale/category');
        $data['data'] = $this->model_hotsale_category->find($id);
        $data['post_url'] = $this->url->link('hotsale/index/update_data','token=' . $this->session->data['token'].'&id='.$id,true);
        $this->form($data);
    }

    public function add_data(){
        $this->load->model('hotsale/category');
        $post = $this->request->post['data'];
        $data['return'] = $this->model_hotsale_category->add($post);
        $this->response->setOutput(json_encode($data));
    }

    public function update_data(){
        $this->load->model('hotsale/category');
        $post = $this->request->post['data'];
        $data['return'] = $this->model_hotsale_category->update($post);
        $this->response->setOutput(json_encode($data));
    }

    public function getList(){
        $this->load->model('hotsale/category');
        $data['category'] = $this->model_hotsale_category->getList();
        $this->response->setOutput(json_encode($data));
    }

    public function delt(){
        $this->load->model('hotsale/category');
        $id = $this->request->post['id'];
        $data['return'] = $this->model_hotsale_category->delete($id);
        $this->response->jsonOutput($data);
    }
}
