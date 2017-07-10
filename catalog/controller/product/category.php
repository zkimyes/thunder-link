<?php
class ControllerProductCategory extends Controller {

	public function index() {
		$this->load->language('product/category');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}


        if (isset($this->request->get['tag'])) {
            $tag = $this->request->get['tag'];
        } else {
            $tag = '';
        }

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
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

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_product_limit');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => $this->url->link('common/home')
		);

        $data['breadcrumbs'][] = array(
            'text' => "Products",
            'href' => $this->url->link('product/index')
        );

		if (isset($this->request->get['path'])) {
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

            $path = $this->request->get['path'];
            $path_info = $this->model_catalog_category->getCategory($path);//当前分类
            if($path_info['parent_id']>0){//二级菜单
                $category_id = $path; //当前要展示的分类ID
                $parent_category_id = $path_info['parent_id'];
                $category_info = $path_info;
                $data['category_sublings'] = $this->model_catalog_category->getCategories($path_info['parent_id']);//同级菜单
            }else{//顶级菜单
                $data['category_sublings'] = $this->model_catalog_category->getCategories($path_info['category_id']);//同级菜单
                $category_id = $data['category_sublings'][0]['category_id'];
                $category_info = $data['category_sublings'][0];
                $parent_category_id = $data['category_sublings'][0]['parent_id'];
            }





            $data['parent_category'] = $this->model_catalog_category->getCategory($parent_category_id);//父级分类
            if($data['parent_category']){
                $data['breadcrumbs'][] = array(
                    'text' => $data['parent_category']['name'],
                    'href' => $this->url->link('product/category', 'path=' . $data['parent_category']['category_id'] . $url)
                );
            }

            $data['breadcrumbs'][] = array(
                'text' => $category_info['name'],
                'href' => $this->url->link('product/category', 'path=' . $category_info['category_id'] . $url)
            );


            foreach($data['category_sublings'] as &$ca){
                if($category_id == $ca['category_id']){
                    $ca['active'] = true;
                }else{
                    $ca['active'] = false;
                }
                $ca['href'] = $this->url->link("product/category","&path=".$ca['category_id']);
            }


            //filters
            $data['filters'] = array();
            $data_filters = $this->model_catalog_category->getCategoryFilters($category_id);
            $r_filter = explode(',',$filter);
            foreach($data_filters as &$v){
                if(!empty($v['filter'])){
                    foreach($v['filter'] as &$f){
                        if(in_array($f['filter_id'],$r_filter) && !empty($f)){
                            $f  = array(
                                'filter_id'=>$f['filter_id'],
                                'name'=>$f['name'],
                                'active'=>true,
                                'link'=>$this->url->link('product/category/products','&path='.$category_id.'&filter='.$f['filter_id'],'SSL')
                            );
                        }else{
                            $f = array(
                                'filter_id'=>$f['filter_id'],
                                'name'=>$f['name'],
                                'active'=>false,
                                'link'=>$this->url->link('product/category/products','&path='.$category_id.'&filter='.$f['filter_id'],'SSL')
                            );
                        }

                    }
                    $data['filters'][] = $v;
                }
            }
            $this->document->setTitle($category_info['meta_title']);
            $this->document->setDescription($category_info['meta_description']);
            $this->document->setKeywords($category_info['meta_keyword']);
            $this->document->addLink($this->url->link('product/category', 'path=' . $this->request->get['path']), 'canonical');

            $data['heading_title'] = $category_info['name'];

            $data['active_id'] = $category_id;

            $data['text_refine'] = $this->language->get('text_refine');
            $data['text_empty'] = $this->language->get('text_empty');
            $data['text_quantity'] = $this->language->get('text_quantity');
            $data['text_manufacturer'] = $this->language->get('text_manufacturer');
            $data['text_model'] = $this->language->get('text_model');
            $data['text_price'] = $this->language->get('text_price');
            $data['text_tax'] = $this->language->get('text_tax');
            $data['text_points'] = $this->language->get('text_points');
            $data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
            $data['text_sort'] = $this->language->get('text_sort');
            $data['text_limit'] = $this->language->get('text_limit');


            if ($category_info['banner']) {
                $this->load->model('design/banner');
                $results = $this->model_design_banner->getBanner($category_info['banner']);
                $data['thumb'] = array(
                    'title' => $results[0]['title'],
                    'link'  => $results[0]['link'],
                    'description'=> strip_tags(html_entity_decode($results[0]['description'], ENT_QUOTES, 'UTF-8')),
                    'image' => $this->model_tool_image->resize($results[0]['image'], 1900, 300)
                );
            } else {
                $data['thumb'] = array(
                    'title' => "",
                    'link'  => "",
                    'description'=> "",
                    'image' => ""
                );
            }

            if ($category_info['word_tag']) {
                $word_tag = explode(',',$category_info['word_tag']);
                $data['word_tag'] = $word_tag;
            } else {
                $data['word_tag'] = "";
            }


            if(!empty($tag)){
                $data['nowtag'] = $tag;
            }


            $data['compare'] = $this->url->link('product/compare');


            $data['categories'] = array();


            $data['nowcategory_id'] = $category_id;


            $data['products'] = array();

            $filter_data = array(
                'filter_category_id' => $category_id,
                'filter_filter'      => $filter,
                'sort'               => $sort,
                'filter_tag'         =>$tag,
                'order'              => $order,
                'start'              => ($page - 1) * $limit,
                'limit'              => $limit
            );


            //Products
            $product_total = $this->model_catalog_product->getTotalProducts($filter_data);

            $results = $this->model_catalog_product->getProducts($filter_data);
            foreach ($results as $result) {
                if ($result['image']) {
                    $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                } else {
                    $image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
                }

                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
                    if($result['price'] == '0.0000'){
                        $price = false;
                    }
                } else {
                    $price = false;
                }

                if ((float)$result['special']) {
                    $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $special = false;
                }

                if ($this->config->get('config_tax')) {
                    $tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
                } else {
                    $tax = false;
                }

                if((int)$category_info['mower']){
                    $configs = $this->db->query("select config_category_id from oc_product_to_config WHERE product_id=".(int)$result['product_id']);
                    if(!empty($configs->row)){
                        $config_link = $this->url->link('config/index',"product_id=".$configs->row['config_category_id']);
                    }else{
                        $config_link = "";
                    }
                    $data['products'][] = array(
                        'product_id'  => $result['product_id'],
                        'thumb'       => $image,
                        'name'        => $result['name'],
                        'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                        'price'       => $price,
                        'special'     => $special,
                        'tax'         => $tax,
                        'model'       => $result['model'],
                        'part_number' => $result['mpn'],
                        'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
                        'rating'      => $result['rating'],
                        'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url),
                        'config'      =>$config_link,
                    );
                }else{
                    $data['products'][] = array(
                        'product_id'  => $result['product_id'],
                        'thumb'       => $image,
                        'name'        => $result['name'],
                        'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                        'price'       => $price,
                        'special'     => $special,
                        'tax'         => $tax,
                        'model'       => $result['model'],
                        'part_number' => $result['mpn'],
                        'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
                        'rating'      => $result['rating'],
                        'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url)
                    );
                }
            }


            $pagination = new Pagination();
            $pagination->total = $product_total;
            $pagination->page = $page;
            $pagination->limit = $limit;
            $pagination->url = $this->url->link('product/category/', 'path=' . $this->request->get['path'] . $url . '&page={page}');

            $data['pagination'] = $pagination->render();

            $data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

            $data['sort'] = $sort;
            $data['order'] = $order;
            $data['limit'] = $limit;


            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');
            $data['quote'] = $this->load->controller('module/quote');
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/category.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/category.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/product/category.tpl', $data));
            }
		} else {
            //没有path的情况
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/category.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/category.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/product/category.tpl', $data));
            }
		}

	}

    public function getProductPlan(){
        $json = array();

        if (isset($this->request->get['product_id'])) {
            $results = $this->db->query("select DISTINCT(description) from oc_config_plans WHERE link_product_id=".(int)$this->request->get['product_id']);
            $results = $results->row;
            $json = array(
                'description' => strip_tags(html_entity_decode($results['description'], ENT_QUOTES, 'UTF-8'))
            );
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}