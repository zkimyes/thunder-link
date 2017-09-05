<?php
class ControllerHotSaleProduct extends Controller {
	private $error = array();
    
    public function index(){
        $this->document->addScript('/admin/view/javascript/vue/vue.min.js');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

        $data['getList_url'] = $this->url->link('hotsale/product/getList','token=' . $this->session->data['token'],true);
        $data['delt_url'] = $this->url->link('hotsale/product/delt','token=' . $this->session->data['token'],true);
        $data['update_url'] = $this->url->link('hotsale/product/edit','token=' . $this->session->data['token'],true);
        $data['add_url'] = $this->url->link('hotsale/product/add','token=' . $this->session->data['token'],true);
        $this->response->setOutput($this->load->view('hotsale/product_list', $data));
    } 

    public function form($data){
        $this->load->model('hotsale/category');
        $this->document->addScript('/admin/view/javascript/vue/vue.min.js');
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
        $data['product_search_url'] = $this->url->link('configuration/typical/getProduct');
        $data['token'] = $this->session->data['token'];
        $data['categoris'] = json_encode($this->model_hotsale_category->getList());
        $data['backurl'] = $this->url->link('hotsale/product','token=' . $this->session->data['token'],true);
 		$this->response->setOutput($this->load->view('hotsale/product_form', $data));
    }


    public function add(){
        $data['action'] = 'Add';
        $data['post_url'] = $this->url->link('hotsale/product/add_data','token=' . $this->session->data['token'],true);
        $this->form($data);
    }

    public function edit(){
        $data['action'] = 'Update';
        $id = $this->request->get['id'];
        $this->load->model('hotsale/product');
        $data['data'] = $this->model_hotsale_product->find($id);
        $data['post_url'] = $this->url->link('hotsale/product/update_data','token=' . $this->session->data['token'].'&id='.$id,true);
        $this->form($data);
    }

    public function add_data(){
        $this->load->model('hotsale/product');
        $post = $this->request->post['data'];
        $data['return'] = $this->model_hotsale_product->add($post);
        $this->response->setOutput(json_encode($data));
    }

    public function update_data(){
        $this->load->model('hotsale/product');
        $post = $this->request->post['data'];
        $data['return'] = $this->model_hotsale_product->update($post);
        $this->response->setOutput(json_encode($data));
    }

    public function getList(){
        $this->load->model('hotsale/product');
        $data['product'] = $this->model_hotsale_product->getList();
        $this->response->jsonOutput($data);
    }

    public function delt(){
        $this->load->model('hotsale/product');
        $id = $this->request->post['id'];
        $data['return'] = $this->model_hotsale_product->delete($id);
        $this->response->jsonOutput($data);
    }
}
