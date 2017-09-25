<?php
class ControllerProductHotsale extends Controller {
	public function index() {

		$this->load->model('tool/image');

		$this->document->addStyle('catalog/view/theme/default/stylesheet/hot_sale.css');
		$hotSaleCategories = $this->db->query('select id,name from oc_hot_sale_category order by sort_order desc');
		$data['hot_sale_category'] = $hotSaleCategories->rows;

		foreach($data['hot_sale_category'] as &$category){
			$products = $this->db->query('select p.product_id,d.name,p.image,p.price,p.tax_class_id,d.description,s.name as stock_status from oc_hot_sale_product t left join oc_product p on p.product_id = t.product_id left join oc_product_description d on d.product_id = p.product_id left join oc_stock_status s on s.stock_status_id = p.stock_status_id where t.category_id = '.(int)$category['id']);
			foreach($products->rows as &$product){
				if ($product['image'] && is_file(DIR_IMAGE.'/'.$product['image'])) {
					$product['thumb'] = $this->model_tool_image->resize($product['image'], 210,160);
				} else {
					$product['thumb'] = $this->model_tool_image->resize('placeholder.png', 210,160);
				}
				$product['price'] = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				$product['description'] = utf8_substr(strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')), 0, 160) . '..';
				$product['href'] = $this->url->link('product/product', 'product_id=' . $product['product_id']);
			}

			
			$category['products'] = $products->rows;
		}


		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('product/hotsale', $data));
	}
}
