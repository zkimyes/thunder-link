<?php
class ControllerPromotionIndex extends Controller{
    public function index(){
        $this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));
		$this->document->addStyle('catalog/view/theme/default/stylesheet/promotion.css');

		//promotion 列表
		$data['promotions'] = [];
		for($i=0;$i<10;$i++){
			$data['promotions'][$i] = [
				'id'=>$i,
				'product_name'=>'Huawei OptiX OSN3500',
				'img'=>'/image/u672.png',
				'desc'=>'No package，Second-hand，31 unti in stock',
				'pcs'=>16,
				'status'=>'in stock',
				'price'=>35000
			];
		}
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('promotion/index', $data));
    }
}