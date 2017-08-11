<?php
class ControllerConfigurationSelect extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));
		$this->document->addStyle('catalog/view/theme/default/stylesheet/configure.css');
		$this->document->addScript('catalog/view/javascript/app/configure.js');
		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = null;
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->load->model('tool/image');
        $this->load->model('configuration/category');
		$this->load->model('configuration/board_type');
        $this->load->model('configuration/typical');
		$data['categorys'] = $this->model_configuration_category->getList();

        foreach($data['categorys'] as &$category){
            if (!empty($category['image']) && is_file(DIR_IMAGE . $category['image'])) {
                $category['thumb'] = $this->model_tool_image->resize($category['image'], 50, 50);
            } else {
                $category['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
            }

            $category['url'] = $this->url->link('configuration/index','category_id='.$category['category_id']);
        }

		$data['board_types'] = $this->model_configuration_board_type->getList();

		$data['board_list'] = [
			'1'=>[
				'0'=>[
					'name'=>'SSN2GSCC',
					'desc'=>'Description:System Control and Communication Board',
					'quantity'=>100
				],
				'1'=>[
					'name'=>'SSN2GSCC',
					'desc'=>'Description:System Control and Communication Board',
					'quantity'=>100
				],
				'2'=>[
					'name'=>'SSN2GSCC',
					'desc'=>'Description:System Control and Communication Board',
					'quantity'=>100
				]
			]
		];

		if(is_ajax_request()){
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($data['board_list'][1]));
		}else{
			$this->response->setOutput($this->load->view('configuration/select', $data));
		}
	}

}


function is_ajax_request(){
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        return true;
    }
    else
    {
        return false;
    }
}