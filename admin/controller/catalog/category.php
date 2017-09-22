<?php
class ControllerCatalogCategory extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/category');

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/category');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_category->addCategory($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/category');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_category->editCategory($this->request->get['category_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/category');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $category_id) {
				$this->model_catalog_category->deleteCategory($category_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	public function repair() {
		$this->load->language('catalog/category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/category');

		if ($this->validateRepair()) {
			$this->model_catalog_category->repairCategories();

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('catalog/category', 'token=' . $this->session->data['token'], true));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('catalog/category/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('catalog/category/delete', 'token=' . $this->session->data['token'] . $url, true);
		$data['repair'] = $this->url->link('catalog/category/repair', 'token=' . $this->session->data['token'] . $url, true);

		$data['categories'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$category_total = $this->model_catalog_category->getTotalCategories();

		$results = $this->model_catalog_category->getCategories($filter_data);

		foreach ($results as $result) {
			$data['categories'][] = array(
				'category_id' => $result['category_id'],
				'name'        => $result['name'],
				'sort_order'  => $result['sort_order'],
				'edit'        => $this->url->link('catalog/category/edit', 'token=' . $this->session->data['token'] . '&category_id=' . $result['category_id'] . $url, true),
				'delete'      => $this->url->link('catalog/category/delete', 'token=' . $this->session->data['token'] . '&category_id=' . $result['category_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_rebuild'] = $this->language->get('button_rebuild');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/category', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_sort_order'] = $this->url->link('catalog/category', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $category_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($category_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($category_total - $this->config->get('config_limit_admin'))) ? $category_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $category_total, ceil($category_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['get_solution'] = $this->url->link('catalog/category/getSolutions');
		$data['get_banner'] = $this->url->link('catalog/category/getBanners');
		$data['get_product'] = $this->url->link('catalog/category/getProducts');
		$data['save_all_category'] = $this->url->link('catalog/category/save_all_category');
		$data['save_solutions'] = $this->url->link('catalog/category/save_solutions');
		$data['save_menu_category'] = $this->url->link('catalog/category/save_menu_category');
		$data['token'] = $this->session->data['token'];
		$data['getSolutionByCategory'] = $this->url->link('catalog/category/getSolutionByCategory');
		$data['getMenuAdsByCategory'] = $this->url->link('catalog/category/getMenuAdsByCategory');
		$data['getAllCategoryByCategory'] = $this->url->link('catalog/category/getAllCategoryByCategory');
		$this->response->setOutput($this->load->view('catalog/category_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['category_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_parent'] = $this->language->get('entry_parent');
		$data['entry_filter'] = $this->language->get('entry_filter');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_top'] = $this->language->get('entry_top');
		$data['entry_column'] = $this->language->get('entry_column');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_layout'] = $this->language->get('entry_layout');

		$data['help_filter'] = $this->language->get('help_filter');
		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['help_top'] = $this->language->get('help_top');
		$data['help_column'] = $this->language->get('help_column');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_design'] = $this->language->get('tab_design');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = array();
		}

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['category_id'])) {
			$data['action'] = $this->url->link('catalog/category/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('catalog/category/edit', 'token=' . $this->session->data['token'] . '&category_id=' . $this->request->get['category_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('catalog/category', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['category_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$category_info = $this->model_catalog_category->getCategory($this->request->get['category_id']);
		}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['category_description'])) {
			$data['category_description'] = $this->request->post['category_description'];
		} elseif (isset($this->request->get['category_id'])) {
			$data['category_description'] = $this->model_catalog_category->getCategoryDescriptions($this->request->get['category_id']);
		} else {
			$data['category_description'] = array();
		}

		if (isset($this->request->post['path'])) {
			$data['path'] = $this->request->post['path'];
		} elseif (!empty($category_info)) {
			$data['path'] = $category_info['path'];
		} else {
			$data['path'] = '';
		}

		if (isset($this->request->post['parent_id'])) {
			$data['parent_id'] = $this->request->post['parent_id'];
		} elseif (!empty($category_info)) {
			$data['parent_id'] = $category_info['parent_id'];
		} else {
			$data['parent_id'] = 0;
		}

		$this->load->model('catalog/filter');

		if (isset($this->request->post['category_filter'])) {
			$filters = $this->request->post['category_filter'];
		} elseif (isset($this->request->get['category_id'])) {
			$filters = $this->model_catalog_category->getCategoryFilters($this->request->get['category_id']);
		} else {
			$filters = array();
		}

		$data['category_filters'] = array();

		foreach ($filters as $filter_id) {
			$filter_info = $this->model_catalog_filter->getFilter($filter_id);

			if ($filter_info) {
				$data['category_filters'][] = array(
					'filter_id' => $filter_info['filter_id'],
					'name'      => $filter_info['group'] . ' &gt; ' . $filter_info['name']
				);
			}
		}

		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['category_store'])) {
			$data['category_store'] = $this->request->post['category_store'];
		} elseif (isset($this->request->get['category_id'])) {
			$data['category_store'] = $this->model_catalog_category->getCategoryStores($this->request->get['category_id']);
		} else {
			$data['category_store'] = array(0);
		}

		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($category_info)) {
			$data['keyword'] = $category_info['keyword'];
		} else {
			$data['keyword'] = '';
		}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($category_info)) {
			$data['image'] = $category_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($category_info) && is_file(DIR_IMAGE . $category_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($category_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->post['top'])) {
			$data['top'] = $this->request->post['top'];
		} elseif (!empty($category_info)) {
			$data['top'] = $category_info['top'];
		} else {
			$data['top'] = 0;
		}

		if (isset($this->request->post['column'])) {
			$data['column'] = $this->request->post['column'];
		} elseif (!empty($category_info)) {
			$data['column'] = $category_info['column'];
		} else {
			$data['column'] = 1;
		}

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($category_info)) {
			$data['sort_order'] = $category_info['sort_order'];
		} else {
			$data['sort_order'] = 0;
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($category_info)) {
			$data['status'] = $category_info['status'];
		} else {
			$data['status'] = true;
		}

		if (isset($this->request->post['category_layout'])) {
			$data['category_layout'] = $this->request->post['category_layout'];
		} elseif (isset($this->request->get['category_id'])) {
			$data['category_layout'] = $this->model_catalog_category->getCategoryLayouts($this->request->get['category_id']);
		} else {
			$data['category_layout'] = array();
		}


		if(isset($this->request->get['cateogry_id'])){
			$data['category_id'] = $this->request->get['category_id'];
		}else{
			$data['category_id'] = null;
		}

		$this->load->model('design/layout');

		/**
		 * all category 页面的设置
		 */
		if(isset($this->request->get['category_id'])){
			$all_category_setting = $this->db->query('select * from oc_all_category where category_id ='.(int)$this->request->get['category_id']);
			$data['all_category_banner_center'] =null;
			$data['all_category_banner_right_top'] = null;
			$data['all_category_banner_right_bottom'] = null;
			$data['all_category_product_id'] = null;
			if($all_category_setting->row){
				if($all_category_setting->row['all_category_banner_center']){
					$data['all_category_banner_center'] = $this->db->query('select * from oc_banner where banner_id='.(int)$all_category_setting->row['all_category_banner_center']);
					$data['all_category_banner_center'] = json_encode($data['all_category_banner_center']->row,true);
				}
				if($all_category_setting->row['all_category_banner_right_top']){
					$data['all_category_banner_right_top'] = $this->db->query('select * from oc_banner where banner_id='.(int)$all_category_setting->row['all_category_banner_right_top']);
					$data['all_category_banner_right_top'] = json_encode($data['all_category_banner_right_top']->row,true);
				}
				if($all_category_setting->row['all_category_banner_right_bottom']){
					$data['all_category_banner_right_bottom'] = $this->db->query('select * from oc_banner where banner_id='.(int)$all_category_setting->row['all_category_banner_center']);
					$data['all_category_banner_right_bottom'] = json_encode($data['all_category_banner_right_bottom']->row,true);
				}
				if($all_category_setting->row['all_category_product_id']){
					$data['all_category_product_id'] = $this->db->query('select p.product_id,d.name from oc_product p left join oc_product_description d on d.product_id = p.product_id where p.product_id='.(int)$all_category_setting->row['all_category_product_id']);
					$data['all_category_product_id'] = json_encode($data['all_category_product_id']->row,true);
				}
			}
		}

		/**
		 * 目录上的ad设置
		 */
		
		if(isset($this->request->get['category_id'])){
			$oc_category_menu_ads = $this->db->query('select * from oc_menu_category where category_id ='.(int)$this->request->get['category_id']);
			$data['banner_big'] =null;
			$data['banner_product_1'] = null;
			$data['banner_product_2'] = null;
			$data['banner_product_3'] = null;
			if($oc_category_menu_ads->row){
				if($oc_category_menu_ads->row['banner_big']){
					$banner_big = $this->db->query('select * from oc_banner where banner_id='.(int)$oc_category_menu_ads->row['banner_big']);
					if($banner_big->row){
						$data['banner_big'] = json_encode($banner_big->row,true);
					}
					
				}
				if($oc_category_menu_ads->row['banner_product_1']){
					$banner_product_1 = $this->db->query('select * from oc_banner where banner_id='.(int)$oc_category_menu_ads->row['banner_product_1']);
					if($banner_product_1->row){
						$data['banner_product_1'] = json_encode($banner_product_1->row,true);
					}
					
				}
				if($oc_category_menu_ads->row['banner_product_2']){
					$banner_product_2 = $this->db->query('select * from oc_banner where banner_id='.(int)$oc_category_menu_ads->row['banner_product_2']);
					if($banner_product_2->row){
						$data['banner_product_2'] = json_encode($banner_product_2->row,true);
					}
				}
				if($oc_category_menu_ads->row['banner_product_3']){
					$banner_product_3 = $this->db->query('select * from oc_banner where banner_id='.(int)$oc_category_menu_ads->row['banner_product_3']);
					if($banner_product_3->row){
						$data['banner_product_3'] = json_encode($banner_product_3->row,true);
					}
				}
			}
		}
		


		$data['layouts'] = $this->model_design_layout->getLayouts();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('catalog/category_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['category_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}

			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}

		if (utf8_strlen($this->request->post['keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

			if ($url_alias_info && isset($this->request->get['category_id']) && $url_alias_info['query'] != 'category_id=' . $this->request->get['category_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($url_alias_info && !isset($this->request->get['category_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}
		}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
		
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateRepair() {
		if (!$this->user->hasPermission('modify', 'catalog/category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/category');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_catalog_category->getCategories($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'category_id' => $result['category_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	/**
	 * 目录上绑定的solution
	 *
	 * @return void
	 */
	public function getSolutionByCategory(){
		if(isset($this->request->post['category_id']) && !empty($this->request->post['category_id'])){
			$query = $this->db->query('select s.*,a.title from oc_category_solution s left join oc_solution_article a on a.id = s.solution_id where s.category_id ='.(int)$this->request->post['category_id']);
			$this->response->jsonOutput([
				'status'=>'success',
				'data'=>$query,
				'msg'=>''
			]);
		}else{
			$this->response->jsonOutput([
				'status'=>'error',
				'msg'=>'category_id 不能为空'
			]);
		}
		
	}

	/**
	 * 获取目录上绑定的设置
	 *
	 * @return void
	 */
	public function getAllCategoryByCategory(){
		if(isset($this->request->post['category_id']) && !empty($this->request->post['category_id'])){
			$category_id = (int)$this->request->post['category_id'];
			$sql = "
				select b.name,m.all_category_product_id as product_id from oc_product_description b left join oc_all_category m on m.all_category_product_id = b.product_id where m.category_id = $category_id UNION ALL
				select b.name,m.all_category_banner_center as banner_id from oc_banner b left join oc_all_category m on m.all_category_banner_center = b.banner_id where m.category_id = $category_id UNION ALL
				select b.name,m.all_category_banner_right_top as banner_id from oc_banner b left join oc_all_category m on m.all_category_banner_right_top = b.banner_id where m.category_id = $category_id UNION ALL
				select b.name,m.all_category_banner_right_bottom as banner_id from oc_banner b left join oc_all_category m on m.all_category_banner_right_bottom = b.banner_id where m.category_id = $category_id
			";

			$query = $this->db->query($sql);
			$this->response->jsonOutput([
				'status'=>'success',
				'data'=>$query,
				'msg'=>''
			]);
		}else{
			$this->response->jsonOutput([
				'status'=>'error',
				'msg'=>'category_id 不能为空'
			]);
		}
	}

	/**
	 * 获取目录上绑定的广告设置
	 *
	 * @return void
	 */
	public function getMenuAdsByCategory(){
		if(isset($this->request->post['category_id']) && !empty($this->request->post['category_id'])){
			$category_id = (int)$this->request->post['category_id'];
			$sql = "
				select b.name,m.* from oc_banner b left join oc_menu_category m on m.banner_big = b.banner_id where m.category_id = $category_id UNION ALL
				select b.name,m.* from oc_banner b left join oc_menu_category m on m.banner_product_1 = b.banner_id where m.category_id = $category_id UNION ALL
				select b.name,m.* from oc_banner b left join oc_menu_category m on m.banner_product_2 = b.banner_id where m.category_id = $category_id UNION ALL
				select b.name,m.* from oc_banner b left join oc_menu_category m on m.banner_product_3 = b.banner_id where m.category_id = $category_id
			";

			$query = $this->db->query($sql);
			$this->response->jsonOutput([
				'status'=>'success',
				'data'=>$query,
				'msg'=>''
			]);
		}else{
			$this->response->jsonOutput([
				'status'=>'error',
				'msg'=>'category_id 不能为空'
			]);
		}
	}

	/**
	 * 通过关键词获取solution
	 *
	 * return void
	 */
	public function getSolutions(){
		$name = '';
		if(isset($this->request->post['name'])){
			$name = $this->request->post['name'];
		}
		$sql = "select * from oc_solution_article where title like '%".$name."%' limit 10";
		$result = $this->db->query($sql);
		$this->response->jsonOutput($result);
	}

	/**
	 * 通过关键词获取banner
	 *
	 * @return void
	 */
	public function getBanners(){
		$name = '';
		if(isset($this->request->post['name'])){
			$name = $this->request->post['name'];
		}
		$sql = "select * from oc_banner where name like '%".$name."%' order by banner_id desc limit 10";
		$result = $this->db->query($sql);
		$this->response->jsonOutput($result);
	}


	/**
	 * 获取产品
	 *
	 * @return void
	 */
	public function getProducts(){
		$name = '';
		if(isset($this->request->post['name'])){
			$name = $this->request->post['name'];
		}
		$sql = "select p.*,d.name from oc_product p left join oc_product_description d on p.product_id = d.product_id where d.name like '%".$name."%' order by p.product_id desc limit 10";
		$result = $this->db->query($sql);
		$this->response->jsonOutput($result);
	}


	/**
	 * 保存关联的solution
	 *
	 * @return void
	 */
	public function save_solutions(){
		$solutions = [];
		$category_id = null;
		if(isset($this->request->post['solutions']) && !empty($this->request->post['solutions'])){
			$solutions = $this->request->post['solutions'];
		}

		if(isset($this->request->post['category_id']) && !empty($this->request->post['category_id'])){
			$category_id = $this->request->post['category_id'];
		}

		if(empty($category_id) && !empty($solutions)){
			$this->response->jsonOutput([
				'status'=>'erro',
				'msg'=>'categoryid 为空'
			]);
		}else{
			$this->db->query('delete from oc_category_solution where category_id = '.$category_id);
			$sql = 'insert into oc_category_solution';
			$sql .= ' (category_id,solution_id) values';
			$values = [];
			foreach($solutions as $k=>$solution){
				$values[$k]='('.$category_id.','.$solution.')';
			}
			$sql .= join(',',$values);
			$query = $this->db->query($sql);
			$this->response->jsonOutput($sql);
		}
	}

	/**
	 * 
	 *保存目录的广告和产品设置
	 * @return void
	 */
	public function save_menu_category(){
		if(isset($this->request->post['category_id']) && !empty($this->request->post['category_id'])){
			$find = $this->db->query('select * from oc_menu_category where category_id ='.(int)$this->request->post['category_id']);
			$sql = '';
			if($find->row){
				$sql .= 'update oc_menu_category set';
				$sql .=' banner_big ='.(int)$this->request->post['banner_big'];
				$sql .=',banner_product_1='.(int)$this->request->post['banner_product_1'];
				$sql .=',banner_product_2='.(int)$this->request->post['banner_product_2'];
				$sql .=',banner_product_3='.(int)$this->request->post['banner_product_3'];
				$sql .=' where category_id='.(int)$this->request->post['category_id'];
			}else{
				$sql .= 'insert into oc_menu_category (category_id,banner_big,banner_product_1,banner_product_2,banner_product_3) values
					('.(int)$this->request->post['category_id'].',
					 '.(int)$this->request->post['banner_big'].',
					 '.(int)$this->request->post['banner_product_1'].',
					 '.(int)$this->request->post['banner_product_2'].',
					 '.(int)$this->request->post['banner_product_3'].'
					)';
			}
			$rs = $this->db->query($sql);
			$this->response->jsonOutput($rs);
		}else{
			$this->reponse->jsonOutput([
				'status'=>'erro',
				'msg'=>'category id 不能为空'
			]);
		}
	}

	/**
	 * 
	 * 保存all category 页面的广告
	 *
	 * @return void
	 */
	public function save_all_category(){
		if(isset($this->request->post['category_id']) && !empty($this->request->post['category_id'])){
			$find = $this->db->query('select * from oc_all_category where category_id ='.(int)$this->request->post['category_id']);
			$sql = '';
			if($find->row){
				$sql .= 'update oc_all_category set';
				$sql .=' all_category_product_id ='.(int)$this->request->post['all_category_product_id'];
				$sql .=',all_category_banner_center='.(int)$this->request->post['all_category_banner_center'];
				$sql .=',all_category_banner_right_top='.(int)$this->request->post['all_category_banner_right_top'];
				$sql .=',all_category_banner_right_bottom='.(int)$this->request->post['all_category_banner_right_bottom'];
				$sql .=' where category_id='.(int)$this->request->post['category_id'];
			}else{
				$sql .= 'insert into oc_all_category (category_id,all_category_product_id,all_category_banner_center,all_category_banner_right_top,all_category_banner_right_bottom) values
					('.(int)$this->request->post['category_id'].',
					 '.(int)$this->request->post['all_category_product_id'].',
					 '.(int)$this->request->post['all_category_banner_center'].',
					 '.(int)$this->request->post['all_category_banner_right_top'].',
					 '.(int)$this->request->post['all_category_banner_right_bottom'].'
					)';
			}
			$rs = $this->db->query($sql);
			$this->response->jsonOutput($rs);
		}else{
			$this->reponse->jsonOutput([
				'status'=>'erro',
				'msg'=>'category id 不能为空'
			]);
		}
	}
	
}
