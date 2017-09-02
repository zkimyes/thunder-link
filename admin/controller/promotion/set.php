<?php
class ControllerPromotionSet extends Controller {
	private $error = array();
    
    public function index(){
        $this->document->addScript('/admin/view/javascript/vue/vue.min.js');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

        $data['getList_url'] = $this->url->link('promotion/set/getList','token=' . $this->session->data['token'],true);
        $data['delt_url'] = $this->url->link('promotion/set/delt','token=' . $this->session->data['token'],true);
        $data['update_url'] = $this->url->link('promotion/set/edit','token=' . $this->session->data['token'],true);
        $data['add_url'] = $this->url->link('promotion/set/add','token=' . $this->session->data['token'],true);
        $this->response->setOutput($this->load->view('promotion/list', $data));
    } 

    public function form($data){
        $this->load->model('promotion/promotion');
        $this->document->addScript('/admin/view/javascript/vue/vue.min.js');
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
        $data['product_search_url'] = $this->url->link('configuration/typical/getProduct');
        $data['token'] = $this->session->data['token'];
        $data['promotion'] = json_encode($this->model_promotion_promotion->getList());
        $data['backurl'] = $this->url->link('promotion/set','token=' . $this->session->data['token'],true);
 		$this->response->setOutput($this->load->view('promotion/form', $data));
    }


    public function add(){
        $data['action'] = 'Add';
        $data['post_url'] = $this->url->link('promotion/set/add_data','token=' . $this->session->data['token'],true);
        $this->form($data);
    }

    public function edit(){
        $data['action'] = 'Update';
        $id = $this->request->get['id'];
        $this->load->model('promotion/promotion');
        $data['data'] = $this->model_promotion_promotion->find($id);
        $data['post_url'] = $this->url->link('promotion/set/update_data','token=' . $this->session->data['token'].'&id='.$id,true);
        $this->form($data);
    }

    public function add_data(){
        $this->load->model('promotion/promotion');
        $post = $this->request->post['data'];
        $data['return'] = $this->model_promotion_promotion->add($post);
        $this->response->setOutput(json_encode($data));
    }

    public function update_data(){
        $this->load->model('promotion/promotion');
        $post = $this->request->post['data'];
        $data['return'] = $this->model_promotion_promotion->update($post);
        $this->response->setOutput(json_encode($data));
    }

    public function getList(){
        $this->load->model('promotion/promotion');
        $data['product'] = $this->model_promotion_promotion->getList();
        $this->response->jsonOutput($data);
    }

    public function delt(){
        $this->load->model('promotion/promotion');
        $id = $this->request->post['id'];
        $data['return'] = $this->model_promotion_promotion->delete($id);
        $this->response->jsonOutput($data);
    }
}
