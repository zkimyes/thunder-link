<?php
class ControllerConfigurationIndex extends Controller {
    public function index() {
        $this->document->setTitle($this->config->get('config_meta_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->setKeywords($this->config->get('config_meta_keyword'));
        $this->document->addStyle('catalog/view/theme/default/stylesheet/configure.css');
        $this->document->addScript('catalog/view/javascript/app/configure.js');
        
        $this->load->model('tool/image');
        $this->load->model('configuration/category');
        $this->load->model('configuration/typical');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = null;
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        
        $data['categorys'] = $this->model_configuration_category->getList();
        
        foreach($data['categorys'] as &$category){
            if (!empty($category['image']) && is_file(DIR_IMAGE . $category['image'])) {
                $category['thumb'] = $this->model_tool_image->resize($category['image'], 50, 50);
            } else {
                $category['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
            }
        }
        
        if(!empty($this->request->get['category_id'])){
            $data['category_id'] = $this->request->get['category_id'];
        }else{
            $data['category_id'] = count($data['categorys'])>0?$data['categorys'][0]['category_id']:null;
        }
        

		$data['typicals'] = $this->model_configuration_typical->getList($condition=[
			'category_id'=>$data['category_id']
		]);

		foreach($data['typicals'] as &$typical){
            if (!empty($typical['image']) && is_file(DIR_IMAGE . $typical['image'])) {
                $typical['thumb'] = $this->model_tool_image->resize($typical['image'], 228, 180);
            } else {
                $typical['thumb'] = $this->model_tool_image->resize('no_image.png', 228, 180);
            }
        }

		var_dump($data['typicals']);
        
        $this->response->setOutput($this->load->view('configuration/index', $data));
    }
    
}