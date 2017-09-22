<?php
class ControllerProductAllCategory extends Controller {
	public function index() {
		$this->load->language('product/category');
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		$this->document->addLink('/catalog/view/theme/default/stylesheet/all_category.css','stylesheet');

		$this->document->setTitle("All Categories");
		$this->document->setDescription("asdasdasdasasdasd");
		$this->document->setKeywords("adasdasd");

		$data['breadcrumbs'] = array();
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['heading_title'] = 'All Categories';
		$data['all_category'] = $this->model_catalog_category->getCategories();
		foreach($data['all_category'] as &$category){
			$category['child_category'] = $this->model_catalog_category->getCategories($category['category_id']);
			$category['link'] =  $this->url->link('product/category', '&path=' . $category['category_id']);
			foreach($category['child_category'] as & $subCategory){
				$subCategory['link'] = $this->url->link('product/category', '&path=' . $category['category_id'].'_'.$subCategory['category_id']);
			}

			$category['description'] = strip_tags(html_entity_decode($category['description']));

			$all_categroy_set = $this->db->query('select * from oc_all_category where category_id = '.(int)$category['category_id']);
			if($all_categroy_set->row){
				$product = $this->db->query('select * from oc_product p left join oc_product_description d on d.product_id = p.product_id where p.product_id ='.(int)$all_categroy_set->row['all_category_product_id']);
				$banners = $this->db->query('
				select b.*,d.title,d.content,i.image,i.link from oc_banner b left join oc_banner_image_description d on d.banner_id = b.banner_id left join oc_banner_image i on b.banner_id = i.banner_id where b.banner_id ='.(int)$all_categroy_set->row['all_category_banner_center'].' UNION ALL 
				select b.*,d.title,d.content,i.image,i.link from oc_banner b left join oc_banner_image_description d on d.banner_id = b.banner_id left join oc_banner_image i on b.banner_id = i.banner_id where b.banner_id ='.(int)$all_categroy_set->row['all_category_banner_right_top'].' UNION ALL
				select b.*,d.title,d.content,i.image,i.link from oc_banner b left join oc_banner_image_description d on d.banner_id = b.banner_id left join oc_banner_image i on b.banner_id = i.banner_id where b.banner_id ='.(int)$all_categroy_set->row['all_category_banner_right_bottom']
				);
				$banners  = $banners->rows;
				$product = $product->row;
				if($banners[0]){			
					if (!empty($banners[0]['image']) && is_file(DIR_IMAGE . $banners[0]['image'])) {
						$banners[0]['thumb'] = $this->model_tool_image->resize($banners[0]['image'], 470, 300);
					} else {
						$banners[0]['thumb'] = $this->model_tool_image->resize('no_image.png', 470, 300);
					}
					$category['banner_center'] = $banners[0];
				}

				if($banners[1]){
					if (!empty($banners[1]['image']) && is_file(DIR_IMAGE . $banners[1]['image'])) {
						$banners[1]['thumb'] = $this->model_tool_image->resize($banners[1]['image'], 210, 140);
					} else {
						$banners[1]['thumb'] = $this->model_tool_image->resize('no_image.png', 210, 140);
					}
					$category['banner_right_top'] = $banners[1];
				}


				if($banners[2]){
					if (!empty($banners[2]['image']) && is_file(DIR_IMAGE . $banners[2]['image'])) {
						$banners[2]['thumb'] = $this->model_tool_image->resize($banners[2]['image'], 210, 140);
					} else {
						$banners[2]['thumb'] = $this->model_tool_image->resize('no_image.png', 210, 140);
					}
					$category['banner_right_bottom'] = $banners[2];
				}

				if($product){
					if (!empty($product['image']) && is_file(DIR_IMAGE . $product['image'])) {
						$product['thumb'] = $this->model_tool_image->resize($product['image'], 210, 180);
					} else {
						$product['thumb'] = $this->model_tool_image->resize('no_image.png', 210, 180);
					}
					$product['link'] = $this->url->link('product/product', '&product_id=' . $product['product_id']);
					$category['product'] = $product;
				}
			}
			
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('product/all_category', $data));
	}
}
