<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		// Analytics
		$this->load->model('extension/extension');

		$data['analytics'] = array();

		$analytics = $this->model_extension_extension->getExtensions('analytics');

		foreach ($analytics as $analytic) {
			if ($this->config->get($analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('analytics/' . $analytic['code'], $this->config->get($analytic['code'] . '_status'));
			}
		}

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['title'] = $this->document->getTitle();

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}


		$this->load->language('common/header');
		$this->load->model('tool/image');

		$data['text_home'] = $this->language->get('text_home');

		// Wishlist
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		}

		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', true), $this->customer->getFirstName(), $this->url->link('account/logout', '', true));

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', true);
		$data['register'] = $this->url->link('account/register', '', true);
		$data['login'] = $this->url->link('account/login', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		$data['logout'] = $this->url->link('account/logout', '', true);
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', true);
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');

		$data['support'] = $this->url->link('support/index');
		$data['configuration'] = $this->url->link('configuration/index');
		$data['solution'] = $this->url->link('solution/index');
		$data['contact_us'] = $this->url->link('contact_us/index');
		
		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = $this->model_catalog_category->getCategories(0);

		foreach ($data['categories'] as &$category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();
				$children_ids = [];
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				
				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

					$children_data[] = array(
						//'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'name'=>$child['name'],
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
					$children_ids[] = $child['category_id'];
				}

				// Level 1
				$category = array(
					'category_id' => $category['category_id'],
					'name'     => html_entity_decode($category['name']),
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);


				// level 3
				if(!empty($children_ids)){
					$tre_catgoryies = $this->db->query('
						select c.category_id,c.parent_id,d.name from oc_category c left join
						 oc_category_description d on d.category_id = c.category_id where c.parent_id in ('.join(',',$children_ids).') and c.status = 1 and c.top = 1
						order by sort_order desc
					');
					foreach($tre_catgoryies->rows as $c){
						$category['third_category'][] = [
							'name'  => $c['name'],
							'href'  => $this->url->link('product/category', 'path=' . $category['category_id'].'_'.$c['parent_id'].'_' . $c['category_id'])
						];
					}
				}

				//目录上的广告
				$rs = $this->db->query('select * from oc_menu_category where category_id ='.(int)$category['category_id']);

				if($rs->row){
					$banner_ids = [
						0=>$rs->row['banner_big'],
						1=>$rs->row['banner_product_1'],
						2=>$rs->row['banner_product_2'],
						3=>$rs->row['banner_product_3']
					];

					$banners = $this->db->query('select * from oc_banner b left join oc_banner_image i on b.banner_id = i.banner_id where i.banner_id in ('.implode(',',$banner_ids).')');
					foreach($banners->rows as &$banner){
						if (!empty($banner['image']) && is_file(DIR_IMAGE . $banner['image'])) {
							$banner['thumb'] = $this->model_tool_image->resize($banner['image'], 180, 150);
						} else {
							$banner['thumb'] = $this->model_tool_image->resize('no_image.png', 180, 150);
						}
					}

					if (!empty($banners->rows[0]['image']) && is_file(DIR_IMAGE . $banners->rows[0]['image'])) {
						$banners->rows[0]['thumb'] = $this->model_tool_image->resize($banners->rows[0]['image'], 310, 425);
					} else {
						$banners->rows[0]['thumb'] = $this->model_tool_image->resize('no_image.png', 310, 425);
					}

					$category['banners'] = $banners->rows;
				}

				//目录上的solution
				$solutions = $this->db->query('select s.*,a.title from oc_category_solution s left join oc_solution_article a on a.id = s.solution_id where s.category_id ='.(int)$category['category_id']);
				foreach($solutions->rows as &$solution){
					$solution['link'] = $this->url->link('solution/article','id='.$solution['solution_id']);
				}
				$category['solutions'] = $solutions->rows;
			}

		}

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');
		$data['all_category_url'] = $this->url->link('product/all_category');


		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} elseif (isset($this->request->get['information_id'])) {
				$class = '-' . $this->request->get['information_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}

		return $this->load->view('common/header', $data);
	}
}
