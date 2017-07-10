<?php
class ControllerPackagePackage extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/attribute');

		$this->document->setTitle("Package");

		$this->load->model('package/package');

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/attribute');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('package/package');

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            if(!empty($this->request->post['detail'])){
                $this->request->post['detail'] = json_encode($this->request->post['detail']);
            }
			$this->model_package_package->addPackage($this->request->post);

			$this->session->data['success'] = "Success: You have modified packages!";

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

			$this->response->redirect($this->url->link('package/package', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/attribute');

		$this->document->setTitle("Edit ");

        $this->load->model('package/package');

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            if(!empty($this->request->post['detail'])){
                $this->request->post['detail'] = json_encode($this->request->post['detail']);
            }


            $this->model_package_package->editPackage($this->request->get['package_id'],$this->request->post);

			$this->session->data['success'] = "Success: You have modified packages!";

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

            $this->response->redirect($this->url->link('package/package', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/attribute');

		$this->document->setTitle("Package");

		$this->load->model('package/package');

		if (isset($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $package_id) {
				$this->model_package_package->deletePackage($package_id);
			}

			$this->session->data['success'] = " Success: You have modified packages!";

			$url = '';


			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('package/package', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';


		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Package',
			'href' => $this->url->link('package/package', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('package/package/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('package/package/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['packages'] = array();

		$filter_data = array(
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$package_total = $this->model_package_package->getTotal();
		$results = $this->model_package_package->getPackages($filter_data);

		foreach ($results as $result) {
			$data['packages'][] = array(
				'package_id'    => $result['package_id'],
				'title'            => $result['title'],
				'sort_order'      => $result['sort_order'],
				'edit'            => $this->url->link('package/package/edit', 'token=' . $this->session->data['token'] . '&package_id=' . $result['package_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = 'Packages';

		$data['text_list'] = 'Package List';
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = "Package Name";
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

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}



		$pagination = new Pagination();
		$pagination->total = $package_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('package/package', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($package_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($package_total - $this->config->get('config_limit_admin'))) ? $package_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $package_total, ceil($package_total / $this->config->get('config_limit_admin')));

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('package/package_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = "Packages";

		$data['text_form'] = !isset($this->request->get['package_id']) ? "Add Package" : "Edit Package";

		$data['entry_name'] = "Title";
		$data['entry_attribute_group'] = "Description";
        $data['entry_detail'] = "Package Detail";
		$data['entry_sort_order'] = "Sort Order";

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

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

        $this->load->model('package/package');

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('package/package', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['package_id'])) {
			$data['action'] = $this->url->link('package/package/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('package/package/edit', 'token=' . $this->session->data['token'] . '&package_id=' . $this->request->get['package_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('package/package', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['package_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $package_info = $this->model_package_package->getPackage($this->request->get['package_id']);
		}

        if (isset($this->request->post['title'])) {
            $data['title'] = $this->request->post['title'];
        } elseif (isset($this->request->get['package_id'])) {
            $data['title'] = $package_info['title'];
        } else {
            $data['title'] = "";
        }

		if (isset($this->request->post['description'])) {
			$data['description'] = $this->request->post['description'];
		} elseif (isset($this->request->get['package_id'])) {
			$data['description'] = $package_info['description'];
		} else {
			$data['description'] = "";
		}


        if (isset($this->request->post['detail'])) {
            $data['detail'] = $this->request->post['detail'];
        } elseif (isset($this->request->get['package_id'])) {
            $data['detail'] = json_decode($package_info['detail'],true);
        } else {
            $data['detail'] = array();
        }

        if (isset($this->request->post['main_product'])) {
            $data['main_product'] = $this->request->post['main_product'];
        } elseif (isset($this->request->get['package_id'])) {
            $data['main_product'] = $package_info['main_product'];
        } else {
            $data['main_product'] = "";
        }

        if (isset($this->request->post['config_category'])) {
            $data['config_category'] = $this->request->post['config_category'];
            $data['configCategory'] = $this->db->query("select * from oc_config_category WHERE category_id = ".(int)$this->request->post['config_category']);
            $data['configCategory'] = $data['configCategory']->row;
        } elseif (isset($this->request->get['package_id'])) {
            $data['config_category'] = $package_info['config_category'];
            $data['configCategory'] = $this->db->query("select * from oc_config_category WHERE category_id = ".(int)$package_info['config_category']);
            $data['configCategory'] = $data['configCategory']->row;
        } else {
            $data['config_category'] = '';
        }

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (isset($this->request->get['package_id'])) {
			$data['sort_order'] = $package_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

        $data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('package/package_form.tpl', $data));
	}


	public function autocomplete() {
        $json = array();

        if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {
            $this->load->model('catalog/product');
            $this->load->model('catalog/option');

            if (isset($this->request->get['filter_name'])) {
                $filter_name = $this->request->get['filter_name'];
            } else {
                $filter_name = '';
            }

            if (isset($this->request->get['filter_model'])) {
                $filter_model = $this->request->get['filter_model'];
            } else {
                $filter_model = '';
            }

            if (isset($this->request->get['limit'])) {
                $limit = $this->request->get['limit'];
            } else {
                $limit = 5;
            }

            $filter_data = array(
                'filter_name'  => $filter_name,
                'filter_model' => $filter_model,
                'start'        => 0,
                'limit'        => $limit
            );

            $results = $this->model_catalog_product->getProducts($filter_data);

            foreach ($results as $result) {
                $option_data = array();

                $product_options = $this->model_catalog_product->getProductOptions($result['product_id']);

                foreach ($product_options as $product_option) {
                    $option_info = $this->model_catalog_option->getOption($product_option['option_id']);

                    if ($option_info) {
                        $product_option_value_data = array();

                        foreach ($product_option['product_option_value'] as $product_option_value) {
                            $option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);

                            if ($option_value_info) {
                                $product_option_value_data[] = array(
                                    'product_option_value_id' => $product_option_value['product_option_value_id'],
                                    'option_value_id'         => $product_option_value['option_value_id'],
                                    'name'                    => $option_value_info['name'],
                                    'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
                                    'price_prefix'            => $product_option_value['price_prefix']
                                );
                            }
                        }

                        $option_data[] = array(
                            'product_option_id'    => $product_option['product_option_id'],
                            'product_option_value' => $product_option_value_data,
                            'option_id'            => $product_option['option_id'],
                            'name'                 => $option_info['name'],
                            'type'                 => $option_info['type'],
                            'value'                => $product_option['value'],
                            'required'             => $product_option['required']
                        );
                    }
                }

                $json[] = array(
                    'product_id' => $result['product_id'],
                    'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
                    'model'      => $result['model'],
                    'option'     => $option_data,
                    'price'      => $result['price']
                );
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
	}



    public function getconfigcatalog() {
        $json = array();

        if (isset($this->request->get['filter_name'])) {

            if (isset($this->request->get['filter_name'])) {
                $filter_name = $this->request->get['filter_name'];
            } else {
                $filter_name = '';
            }


            if (isset($this->request->get['limit'])) {
                $limit = $this->request->get['limit'];
            } else {
                $limit = 5;
            }

            $filter_data = array(
                'filter_name'  => $filter_name,
                'start'        => 0,
                'limit'        => $limit
            );

            $results = $this->db->query("select * from oc_config_category WHERE name LIKE '%".$this->db->escape($filter_data['filter_name'])."%' limit ".$filter_data['start'].",".$filter_data['limit']);
            $results = $results->rows;
            foreach($results as $result){
                $json[] = array(
                    'category_id' => $result['category_id'],
                    'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
                );
            }

        }

       $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}