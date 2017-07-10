<?php

/**
 * config 典型配置
 */
class ControllerConfigPlan extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/category');

		$this->document->setTitle('Config Plans');

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/category');

		$this->document->setTitle("Config Category Items");

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $category_id = (int)$this->request->post['category_id'];
            $image = $this->db->escape($this->request->post['image']);
            $sort_order = (int)$this->request->post['sort_order'];
            $name = $this->db->escape($this->request->post['name']);
            $description = $this->db->escape($this->request->post['description']);
            $link_product_id = (int)$this->request->post['link_product_id'];
            $quote_description = $this->db->escape($this->request->post['quote_description']);

            $this->db->query("INSERT INTO oc_config_plans SET category_id=".$category_id.", image='".$image."', `name`='".$name."', sort_order=".$sort_order.", link_product_id='".$link_product_id."', description='".$description."',quote_description='".$quote_description);

            $this->session->data['success'] = "Success: You have add new category plan!";

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

			$this->response->redirect($this->url->link('config/plan', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/category');

		$this->document->setTitle('Config Category Items');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->db->query("update oc_config_plans SET category_id=".(int)$this->request->post['category_id'].", image='".$this->db->escape($this->request->post['image'])."', `name`='".$this->db->escape($this->request->post['name'])."', sort_order=".(int)$this->request->post['sort_order'].",link_product_id='".(int)$this->request->post['link_product_id']."', description='".$this->db->escape($this->request->post['description'])."',quote_description='".$this->db->escape($this->request->post['quote_description'])."' where plan_id=".(int)$this->request->get['plan_id']);
            $this->session->data['success'] = "Success: You have modified category plan!";

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

			$this->response->redirect($this->url->link('config/plan', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/category');

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $plan_id) {
				$this->db->query("delete from oc_config_plans WHERE plan_id=".(int)$plan_id);
			}

			$this->session->data['success'] = "You have deleted selected";

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

			$this->response->redirect($this->url->link('config/plan', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'text' => 'Plan',
			'href' => $this->url->link('config/plan', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('config/plan/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('config/plan/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['categories'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$category_total = $this->db->query("select count(*) as total from oc_config_plans");
        if($category_total->row){
            $category_total = $category_total->row['total'];
        }else{
            $category_total = 0;
        }
        $sql = "select * from oc_config_plans order by `".$sort."` ".$order." limit ".$filter_data['start'].",".$filter_data['limit'];
		$results = $this->db->query($sql);
        $results = $results->rows;
		foreach ($results as $result) {
			$data['categories'][] = array(
				'plan_id' => $result['plan_id'],
				'name'        => $result['name'],
				'sort_order'  => $result['sort_order'],
				'edit'        => $this->url->link('config/plan/edit', 'token=' . $this->session->data['token'] . '&plan_id=' . $result['plan_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('config/plan/delete', 'token=' . $this->session->data['token'] . '&plan_id=' . $result['plan_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = 'Config Plan';

		$data['text_list'] = "Plan List";
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = "Plan Name";
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

		$data['sort_name'] = $this->url->link('config/plan', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('config/plan', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

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
		$pagination->url = $this->url->link('config/plan', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($category_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($category_total - $this->config->get('config_limit_admin'))) ? $category_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $category_total, ceil($category_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('config/plan_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = 'Config Plan';

		$data['text_form'] = !isset($this->request->get['plan_id']) ? "Add Plan" : "Edit Plan";
		$data['text_none'] = $this->language->get('text_none');

		$data['entry_name'] = "Plan Name";

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_warning'] = $this->error['name'];
		} else {
			$data['error_warning'] = array();
		}

        if (isset($this->error['link_product'])) {
            $data['error_warning'] = $this->error['link_product'];
        } else {
            $data['error_warning'] = array();
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
			'text' => "Plan",
			'href' => $this->url->link('config/plan', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['plan_id'])) {
			$data['action'] = $this->url->link('config/plan/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('config/plan/edit', 'token=' . $this->session->data['token'] . '&plan_id=' . $this->request->get['plan_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('config/plan', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $plan = array();
        $data['plan'] = array();
        if(isset($this->request->get['plan_id'])){
            $plan = $this->db->query("select * from oc_config_plans WHERE plan_id=".(int)$this->request->get['plan_id']);
            $plan = $plan->row;
            if(!empty($plan['link_product_id'])){
                $related_product = $this->db->query("select `name`,product_id from oc_product_description where product_id=".(int)$plan['link_product_id']);
                $plan['link_products'] = $related_product->row;
            }else{
                $plan['link_products'] = array();
            }
        }
        $categories = $this->db->query("select category_id,name from oc_config_category ORDER BY sort_order desc");
        $data['categories'] = $categories->rows;




		$data['token'] = $this->session->data['token'];

        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($plan)) {
            $data['name'] = $plan['name'];
        } else {
            $data['name'] = '';
        }

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($plan)) {
			$data['sort_order'] = $plan['sort_order'];
		} else {
			$data['sort_order'] = 0;
		}

        if (isset($this->request->post['category_id'])) {
            $data['category_id'] = $this->request->post['category_id'];
        } elseif (!empty($plan)) {
            $data['category_id'] = $plan['category_id'];
        } else {
            $data['category_id'] = 0;
        }


        if (isset($this->request->post['description'])) {
            $data['description'] = $this->request->post['description'];
        } elseif (!empty($plan)) {
            $data['description'] = $plan['description'];
        } else {
            $data['description'] = "";
        }

        if (isset($this->request->post['quote_description'])) {
            $data['description'] = $this->request->post['quote_description'];
        } elseif (!empty($plan)) {
            $data['quote_description'] = $plan['quote_description'];
        } else {
            $data['quote_description'] = "";
        }


        $this->load->model('tool/image');

        if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
            $data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
            $data['image'] = $this->request->post['image'];
        } elseif (!empty($plan) && is_file(DIR_IMAGE . $plan['image'])) {
            $data['thumb'] = $this->model_tool_image->resize($plan['image'], 100, 100);
            $data['image'] = $plan['image'];
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
            $data['image'] = "";
        }


        if (isset($this->request->post['link_product_id'])) {
            $data['link_product_id'] = $this->request->post['link_product_id'];
        } elseif (!empty($plan)) {
            $data['link_product_id'] = $plan['link_product_id'];
            $link_products = $this->db->query("select * from oc_product_description WHERE product_id = ".(int)$plan['link_product_id']);
            $data['link_products'] = $link_products->row;
        } else {
            $data['link_product_id'] = "";
        }



        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('config/plan_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'config/category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}


        if (!$this->request->post['name']) {
            $this->error['name'] = "name can't empty";
        }

        if (!isset($this->request->post['link_product_id'])) {
            $this->error['link_product'] = "link_product can't empty";
        }


		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'config/category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateRepair() {
		if (!$this->user->hasPermission('modify', 'config/category')) {
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
}