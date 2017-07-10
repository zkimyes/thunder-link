<?php
class ControllerSolutionSolution extends Controller {
	private $error = array();

	public function index() {
		$this->document->setTitle('solution');

		$this->load->model('catalog/category');

		$this->getList();
	}

	public function add() {

		$this->document->setTitle('solution');


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $post = $this->request->post;
            if(!empty($post['related_product_id'])){
                $post['related_product_id'] = implode(',',$post['related_product_id']);
            }
            if(!empty($post['category_id'])){
                $post['category_id'] = implode(',',$post['category_id']);
            }
			$this->db->query("INSERT INTO oc_solution SET `solution_title`  = '".$post['solution_title']."',`description`= '".$this->db->escape($post['description'])."',`image` = '".$this->db->escape($post['image'])."',`related_product_id` = '".$post['related_product_id']."',`category_id` = '".$post['category_id']."',`order`= ".(int)$post['order'].",`meta_title` = '".$this->db->escape($post['meta_title'])."',`meta_description` = '".$this->db->escape($post['meta_description'])."',`meta_keyword`='".$this->db->escape($post['meta_keyword'])."'");

			$this->db->query("INSERT into oc_url_alias SET query='solution_id=".(int)$this->db->getLastId()."',keyword='".$this->db->escape($post['seo_keyword'])."'");
			$this->session->data['success'] = 'add success';
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

			$this->response->redirect($this->url->link('solution/solution', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $post = $this->request->post;
            if(!empty($post['related_product_id'])){
                $post['related_product_id'] = implode(',',$post['related_product_id']);
            }
            if(!empty($post['category_id'])){
                $post['category_id'] = implode(',',$post['category_id']);
            }
            $this->db->query("update oc_solution SET `solution_title`  = '".$this->db->escape($post['solution_title'])."',`description`= '".$this->db->escape($post['description'])."',`image` = '".$post['image']."',`related_product_id` = '".$post['related_product_id']."',`category_id` = '".$post['category_id']."',`order`= ".(int)$post['order'].",`meta_title` = '".$this->db->escape($post['meta_title'])."',`meta_description` = '".$this->db->escape($post['meta_description'])."',`meta_keyword`='".$this->db->escape($post['meta_keyword'])."' where solution_id= ".(int)$this->request->get['solution_id']);

			$this->db->query("DELETE from oc_url_alias WHERE query='solution_id=".(int)$this->request->get['solution_id']."'");
			$this->db->query("INSERT into oc_url_alias SET query='solution_id=".(int)$this->request->get['solution_id']."',keyword='".$this->db->escape($post['seo_keyword'])."'");
			$this->session->data['success'] = 'edit success';
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

			$this->response->redirect($this->url->link('solution/solution', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {

		$this->document->setTitle('solution');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $solution_id) {
				$this->db->query("delete from oc_solution where solution_id = ".(int)$solution_id);
                $this->db->query("DELETE from oc_url_alias WHERE query='solution_id=".(int)$solution_id."'");
			}

			$this->session->data['success'] = 'delete success';

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

			$this->response->redirect($this->url->link('solution/solution', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'text' => 'solution',
			'href' => $this->url->link('solution/solution', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('solution/solution/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('solution/solution/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['repair'] = $this->url->link('solution/solution', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['categories'] = array();

		$filter_data = array(
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$solution_total = $this->db->query("select count(solution_id) as count from oc_solution");
        $solution_total = $solution_total->row['count'];
		$results = $this->db->query("select * from oc_solution order BY `order`".$order);
        $data['solutions'] = array();
		foreach ($results->rows as $result) {
			$data['solutions'][] = array(
				'solution_id' => $result['solution_id'],
				'solution_title' => $result['solution_title'],
				'order'  => $result['order'],
				'edit'        => $this->url->link('solution/solution/edit', 'token=' . $this->session->data['token'] . '&solution_id=' . $result['solution_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('solution/solution/delete', 'token=' . $this->session->data['token'] . '&solution_id=' . $result['solution_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = 'solution';

		$data['text_list'] = 'solution_list';
		$data['text_no_results'] = 'no result';
		$data['text_confirm'] = 'are you sure';

		$data['column_name'] = 'solution_title';
		$data['column_sort_order'] = 'solution_order';
		$data['column_action'] = 'action';

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

		$data['sort_sort_order'] = $this->url->link('solution/solution', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $solution_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('solution/solution', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($solution_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($solution_total - $this->config->get('config_limit_admin'))) ? $solution_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $solution_total, ceil($solution_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('solution/solution_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = 'Solution';

		$data['text_form'] = !isset($this->request->get['solution_id']) ? 'add solution' : 'edit solution_id';
		$data['text_none'] = $this->language->get('text_none');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = 'solution_title';
		$data['entry_description'] = 'solution_description';
		$data['entry_meta_title'] = 'meta_title';
		$data['entry_meta_description'] = 'meta_description';
		$data['entry_meta_keyword'] = 'meta_keyword';
		$data['entry_keyword'] = 'keyword';
		$data['related_products'] = 'related products';
        $data['categroies'] = array();
		$data['entry_image'] = 'image';
		$data['entry_sort_order'] = 'sort_order';

		$data['help_filter'] = 'related products';
		$data['help_keyword'] = 'keyword';

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

		if (isset($this->error['solution_title'])) {
			$data['error_name'] = $this->error['solution_title'];
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('solution/solution', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['solution_id'])) {
			$data['action'] = $this->url->link('solution/solution/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('solution/solution/edit', 'token=' . $this->session->data['token'] . '&solution_id=' . $this->request->get['solution_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('solution/solution', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['solution_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $solution = $this->db->query("select * from oc_solution where solution_id =".$this->request->get['solution_id']);
		}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

        if(isset($solution) && !empty($solution->row)){
            $data['order'] = $solution->row['order'];
            $data['solution_title'] = $solution->row['solution_title'];
            $data['description'] = $solution->row['description'];
            $data['image'] = $solution->row['image'];
            if(!empty($solution->row['related_product_id'])){
                $as = $this->db->query("select * from oc_solution WHERE solution_id IN (".$solution->row['related_product_id'].")");
                $data['related_product_id'] = $as->rows;
            }else{
                $data['related_product_id'] = array();
            }
            if(!empty($solution->row['category_id'])){
                $bs = $this->db->query("select * from oc_solution_category WHERE category_id IN (".$solution->row['category_id'].")");
                $data['category_id'] = $bs->rows;
            }else{
                $data['category_id'] = array();
            }
            $data['meta_title'] = $solution->row['meta_title'];
            $data['meta_description'] = $solution->row['meta_description'];
            $data['meta_keyword'] = $solution->row['meta_keyword'];
            $seo_keyword = $this->db->query("select * from oc_url_alias WHERE query='solution_id=".(int)$this->request->get['solution_id']."'");
            if($seo_keyword->row){
                $data['seo_keyword'] = $seo_keyword->row['keyword'];
            }
        }

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($solution->row) && is_file(DIR_IMAGE . $solution->row['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($solution->row['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('solution/solution_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'solution/solution')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

        if(empty($this->request->post['solution_title'])){
            $this->error['warning'] = "solution_title is empty";
        }

        if(empty($this->request->post['meta_title'])){
            $this->error['warning'] = "meta_title is empty";
        }
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'solution/solution')) {
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
            $results = $this->db->query("select * from oc_solution  WHERE solution_title LIKE '%".$this->request->get['filter_name']."%' limit 0,10");
			foreach ($results->rows as $result) {
				$json[] = array(
					'solution_id' => $result['solution_id'],
					'name'        => strip_tags(html_entity_decode($result['solution_title'], ENT_QUOTES, 'UTF-8'))
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

    public function getCategory(){
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
            $results = $this->db->query("select * from oc_solution_category WHERE `title` LIKE '%".$filter_data['filter_name']."%' order by `order` asc limit 5 ");
            foreach ($results->rows as $result) {
                $json[] = array(
                    'category_id' => $result['category_id'],
                    'name'        => strip_tags(html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'))
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