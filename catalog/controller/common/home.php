<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');


		$this->load->model('hotsale/products');
		$this->load->model('promotion/promotion');

		//hot sale
		$data['hot_sale_category'] = $this->model_hotsale_products->getHotSaleCategroy();
		$hot_product = $this->model_hotsale_products->getHomeHotSaleList();

		foreach($data['hot_sale_category'] as &$category){
			foreach($hot_product as $product){
				if($product['category_id'] == $category['id']){
					if (!empty($product['image']) && is_file(DIR_IMAGE . $product['image'])) {
						$product['thumb'] = $this->model_tool_image->resize($product['image'], 180, 150);
					} else {
						$product['thumb'] = $this->model_tool_image->resize('no_image.png', 180, 150);
					}
					$product['url'] = $this->url->link('product/product', 'product_id=' . $product['product_id']);
					$category['products'][] = $product;
				}
			}
		}

		//promotion

		$data['promotion'] = $this->model_promotion_promotion->getList();
		foreach($data['promotion'] as &$promotion){
			if (!empty($promotion['image']) && is_file(DIR_IMAGE . $promotion['image'])) {
				$promotion['thumb'] = $this->model_tool_image->resize($promotion['image'], 180, 150);
			} else {
				$promotion['thumb'] = $this->model_tool_image->resize('no_image.png', 180, 150);
			}
			$promotion['url'] = $this->url->link('product/product', 'product_id=' . $promotion['product_id']);
		}


		$this->response->setOutput($this->load->view('common/home', $data));
	}
}