<?php
class ControllerPromotionIndex extends Controller{
    public function index(){
        $this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));
		$this->document->addStyle('catalog/view/theme/default/stylesheet/promotion.css');
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		$data['breadcrumbs'][] = [
			'text'=>'Promotion',
			'href'=>'javascript:;'
		];
		$this->load->model('promotion/promotion');
		$this->load->model('tool/image');
		$url = $this->url->link('promotion/index');
		if(isset($this->request->get['sort']) && !empty($this->request->get['sort'])){
			$sort = $this->request->get['sort'];
		}else{
			$sort = '';
		}

		if(isset($this->request->get['limit']) && !empty($this->request->get['limit'])){
			$limit = $this->request->get['limit'];
		}else{
			$limit = '';
		}

		//promotion 列表
		$data['promotions'] = $this->model_promotion_promotion->getPromotionList([
			'sort'=>$sort,
			'limit'=>$limit
		]);
		foreach($data['promotions'] as &$promotion){
			if (!empty($promotion['image']) && is_file(DIR_IMAGE . $promotion['image'])) {
				$promotion['img'] = $this->model_tool_image->resize($promotion['image'], 166, 138);
            } else {
				$promotion['img'] = $this->model_tool_image->resize('no_image.png', 166, 138);
			}
			$promotion['desc'] = $promotion['condition'];
			$promotion['product_name'] = $promotion['title'];
			$promotion['href'] = $this->url->link('product/product','product_id='.$promotion['product_id']);
		}


		$data['submit_url'] = $url;
		$data['sort'] = $sort;
		$data['limit'] = $limit;
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('promotion/index', $data));
    }
}