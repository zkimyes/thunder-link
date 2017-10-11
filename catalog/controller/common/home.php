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
		$this->load->model('support/article');
		$this->load->model('design/banner');

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


		//support 

		$data['support'] = $this->model_support_article->getHomeArticleList();
		foreach($data['support'] as &$support){
			if (!empty($support['image_in_home']) && is_file(DIR_IMAGE . $support['image_in_home'])) {
				$support['thumb'] = $this->model_tool_image->resize($support['image'], 210, 150);
			} else {
				$support['thumb'] = $this->model_tool_image->resize('no_image.png', 210, 150);
			}
			$support['desc_in_home'] = utf8_substr(strip_tags(html_entity_decode($support['desc_in_home'], ENT_QUOTES, 'UTF-8')), 0, 120) . '..';
			$support['url'] = $this->url->link('support/article', 'article_id=' . $support['id']);
		}


		//获取support栏目块的广告
		$data['home_three_banner'] = $this->modle_design_banner->getHomeThreeBanner();
		foreach($data['support'] as &$support){
			if (!empty($support['image_in_home']) && is_file(DIR_IMAGE . $support['image_in_home'])) {
				$support['thumb'] = $this->model_tool_image->resize($support['image'], 210, 150);
			} else {
				$support['thumb'] = $this->model_tool_image->resize('no_image.png', 210, 150);
			}
			$support['desc_in_home'] = utf8_substr(strip_tags(html_entity_decode($support['desc_in_home'], ENT_QUOTES, 'UTF-8')), 0, 120) . '..';
			$support['url'] = $this->url->link('support/article', 'article_id=' . $support['id']);
		}

		$this->load->model('support/article');
        $data['is_search_tags'] = $this->model_support_article->getIsSeachTags(8);

		$data['promotion_url'] = $this->url->link('promotion/index');
		$data['hotsale_url'] = $this->url->link('product/hotsale');
		$data['support_url'] = $this->url->link('support/index');
		$data['solution_url'] = $this->url->link('solution/index');
		$this->response->setOutput($this->load->view('common/home', $data));
	}
}