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
        if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $attribute_id) {
				$this->model_catalog_attribute->deleteAttribute($attribute_id);
			}
			$this->response->jsonOutput([
                'status'=>'1',
                'info'=>'success'
            ]);
		}
    }
    
    protected function getList() {
        $url = "";
        $data['url'] = $this->url;
        $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, true)
		);
        $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


        include_once(DIR_APPLICATION.'/model/soluton/category.php');
        $category = new SolutionCategory();
        var_dump($category);

        $data['lists'] = json_encode([
            [
                'id'=>'asd',
                'name'=>'asd',
                'meta_title'=>'asd',
                'meta_desc'=>'sdadasd',
                'link'=>'asdasdasd'
            ],
            [
                'id'=>'asd',
                'name'=>'asd',
                'meta_title'=>'asd',
                'meta_desc'=>'sdadasd',
                'link'=>'asdasdasd'
            ],
            [
                'id'=>'asd',
                'name'=>'asd',
                'meta_title'=>'asd',
                'meta_desc'=>'sdadasd',
                'link'=>'asdasdasd'
            ]
        ]);

        $this->response->setOutput($this->load->view('solution/category_list', $data));
    }
}