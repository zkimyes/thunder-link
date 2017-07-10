<?php
class ControllerCatalogInformationCategory extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/information');

		$this->document->setTitle("information category");

		$this->load->model('catalog/information');
		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/information');

        $this->document->setTitle("Information Category");

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$name = $this->request->post['name'];
			$description = $this->request->post['description'];
			$status = 1;
            $sort_order = (int)$this->request->post['sort_order'];
			$create_time = date('Y-m-d H:i:s');
            $type = $this->request->post['type'];
            $meta_title = $this->request->post['meta_title'];
            $meta_keyword = $this->request->post['meta_keyword'];
            $meta_description = $this->request->post['meta_description'];
            $seo_keyword = $this->request->post['seo_keyword'];
            $banner = $this->request->post['banner'];

			$this->db->query("insert into oc_information_category SET name='".$this->db->escape($name)."',description='".$this->db->escape($description)."',meta_title='".$this->db->escape($meta_title)."',meta_keyword='".$this->db->escape($meta_keyword)."',meta_description='".$this->db->escape($meta_description)."',sort_order=".$sort_order.",status=".(int)$status.",create_time='".$create_time."',type=".(int)$type.", banner='".$banner."'");

            $this->db->query("insert into oc_url_alias SET query='".$this->db->escape('infor_category_id='.$this->db->getLastId())."',keyword='".$this->db->escape($seo_keyword)."'");


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

			$this->response->redirect($this->url->link('catalog/informationcategory', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/information');

		$this->document->setTitle("Information Category");

		$this->load->model('catalog/information');

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $name = $this->request->post['name'];
            $description = $this->request->post['description'];
            $status = 1;
            $sort_order = (int)$this->request->post['sort_order'];
            $create_time = date('Y-m-d H:i:s');
            $type = $this->request->post['type'];
            $meta_title = $this->request->post['meta_title'];
            $meta_keyword = $this->request->post['meta_keyword'];
            $meta_description = $this->request->post['meta_description'];
            $seo_keyword = $this->request->post['seo_keyword'];
            $banner = $this->request->post['banner'];

            $this->db->query("update oc_information_category SET name='".$this->db->escape($name)."',description='".$this->db->escape($description)."',meta_title='".$this->db->escape($meta_title)."',meta_keyword='".$this->db->escape($meta_keyword)."',meta_description='".$this->db->escape($meta_description)."',sort_order=".$sort_order.",status=".(int)$status.",create_time='".$create_time."',type='".(int)$type."',banner='".$banner."' where category_id=".(int)$this->request->get['category_id']);

            $this->db->query("delete from oc_url_alias WHERE query='".$this->db->escape('infor_category_id='.$this->request->get['category_id'])."'");
            $this->db->query("insert into oc_url_alias SET query='".$this->db->escape('infor_category_id='.$this->request->get['category_id'])."',keyword='".$this->db->escape($seo_keyword)."'");
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

			$this->response->redirect($this->url->link('catalog/informationcategory', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
        $this->document->setTitle("Information Category");
		$this->load->model('catalog/information');

		if (isset($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $information_id) {
                $this->db->query("delete from oc_url_alias WHERE query='".$this->db->escape('infor_category_id='.$information_id)."'");
				$this->db->query("delete from oc_information_category WHERE category_id=".(int)$information_id);
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

			$this->response->redirect($this->url->link('catalog/informationcategory', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/informationcategory', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/informationcategory/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/informationcategory/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['informations'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$information_total = $this->db->query("select count(*) count from oc_information_category");
		$information_total = $information_total->row['count'];
		if (isset($filter_data['start']) || isset($filter_data['limit'])) {
			if ($filter_data['start'] < 0) {
				$filter_data['start'] = 0;
			}

			if ($filter_data['limit'] < 1) {
				$filter_data['limit'] = 20;
			}
		}
		$results = $this->db->query("select * from oc_information_category WHERE status=1 ORDER BY ".$sort." ".$order." LIMIT " . (int)$filter_data['start'] . "," . (int)$filter_data['limit']);
        $results = $results->rows;
		if(!empty($results)){
			foreach ($results as $result) {
				$data['informations'][] = array(
					'category_id' => $result['category_id'],
					'title'          => $result['name'],
					'sort_order'     => $result['sort_order'],
					'edit'           => $this->url->link('catalog/informationcategory/edit', 'token=' . $this->session->data['token'] . '&category_id=' . $result['category_id'] . $url, 'SSL')
				);
			}
		}


		$data['heading_title'] = "Information Category";

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_title'] = "Category Name";
            $data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

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

		$data['sort_title'] = $this->url->link('catalog/informationcategory', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('catalog/informationcategory', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $information_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/informationcategory', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($information_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($information_total - $this->config->get('config_limit_admin'))) ? $information_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $information_total, ceil($information_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/information_category_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = "Information Category";

		$data['text_form'] = !isset($this->request->get['category_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => "Information Category",
			'href' => $this->url->link('catalog/informationcategory', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['category_id'])) {
			$data['action'] = $this->url->link('catalog/informationcategory/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/informationcategory/edit', 'token=' . $this->session->data['token'] . '&category_id=' . $this->request->get['category_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/informationcategory', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['category_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$category = $this->db->query("select * from oc_information_category WHERE category_id=".(int)$this->request->get['category_id']);
            $data['categroy'] = $category->row;
            $category = $data['categroy'];
            $seo_keyword = $this->db->query("select * from oc_url_alias WHERE query='infor_category_id=".(int)$this->request->get['category_id']."'");
            if($seo_keyword->row){
                $data['seo_keyword'] = $seo_keyword->row['keyword'];
            }
		}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');


		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
        } elseif (!empty($category)) {
            $data['name'] = $category['name'];
        } else {
			$data['name'] = array();
		}

        $this->load->model('tool/image');
        if (!empty($category) && is_file(DIR_IMAGE . $category['banner'])) {
            $data['banner'] = $category['banner'];
            $data['thumb'] = $this->model_tool_image->resize($category['banner'], 100, 100);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
            $data['banner'] = "";
        }


		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($category)) {
			$data['sort_order'] = $category['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

        if (isset($this->request->post['type'])) {
            $data['type'] = $this->request->post['type'];
        } elseif (!empty($information_info)) {
            $data['type'] = $category['type'];
        } else {
            $data['type'] = 1;
        }

        if (isset($this->request->post['meta_title'])) {
            $data['meta_title'] = $this->request->post['meta_title'];
        } elseif (!empty($category)) {
            $data['meta_title'] = $category['meta_title'];
        } else {
            $data['meta_title'] = "";
        }


        if (isset($this->request->post['meta_keyword'])) {
            $data['meta_keyword'] = $this->request->post['meta_keyword'];
        } elseif (!empty($category)) {
            $data['meta_keyword'] = $category['meta_keyword'];
        } else {
            $data['meta_keyword'] = "";
        }

        if (isset($this->request->post['meta_description'])) {
            $data['meta_description'] = $this->request->post['meta_description'];
        } elseif (!empty($category)) {
            $data['meta_description'] = $category['meta_description'];
        } else {
            $data['meta_description'] = "";
        }


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/information_category_form.tpl', $data));
	}

}