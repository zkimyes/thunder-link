<?php
/**
* solution 的目录
* Undocumented class
*/
require_once(DIR_VENDOR.'autoload.php');
use Cake\Datasource\ConnectionManager;

ConnectionManager::setConfig('default', [
	'className' => 'Cake\Database\Connection',
	'driver' => 'Cake\Database\Driver\Mysql',
	'database' =>DB_DATABASE,
	'username' => DB_USERNAME,
	'password' => DB_PASSWORD,
	'cacheMetadata' => false // If set to `true` you need to install the optional "cakephp/cache" package.
]);
use Cake\ORM\TableRegistry;
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


    public function add(){

    }

    public function update(){
        $this->form();
    }


    protected function form(){
        $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
        $data['back_url'] = $this->url->link('solution/category/index');
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
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, true)
		);
        $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

        $data['update_url'] = $this->url->link('solution/category/update');

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

        $data['token'] = $token;
        $this->response->setOutput($this->load->view('solution/category_list', $data));
    }
}