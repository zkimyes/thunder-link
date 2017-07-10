<?php
class ControllerCommonHotsale extends Controller {
    /**
     *
     */
    public function index() {
		$this->document->setTitle("Hot Sale");
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));
        $data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => $this->url->link('common/home')
        );
        $data['breadcrumbs'][] = array(
            'text' => 'Hot Sale',
            'href' => $this->url->link('common/hotsale')
        );
        $this->load->model('tool/image');
        $categorys = $this->db->query("select * from oc_hotsale_category ORDER BY sort_order asc");
        $categorys = $categorys->rows;
        $products= $this->db->query("select * from oc_hotsale_products order by sort_order asc");
        $products = $products->rows;
        foreach($products as &$v){
            $results = $this->db->query("select a.product_id,b.image,a.name from oc_product_description a LEFT JOIN oc_product b ON a.product_id = b.product_id WHERE a.product_id=".(int)$v['product_id']);
            $v['name'] = $results->row['name'];
            if(!empty($results->row['image']) && file_exists(DIR_IMAGE.'/'.$results->row['image'])){
                $v['image'] = $this->model_tool_image->resize($results->row['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
            }else{
                $v['image'] = $this->model_tool_image->resize('no_image.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
            }
            $v['link'] = $this->url->link("product/product","&product_id=".$v['product_id']);
        }
        $data['documents'] = array();
        foreach($categorys as $k=>$category){
            $data['documents'][$k]['name'] = $category['name'];
            foreach($products as $product){
               if($category['id'] == $product['hotsale_category']){
                   $data['documents'][$k]['products'][] = array(
                       'product_id'  => $product['product_id'],
                       'image'       => $product['image'],
                       'name'        => $product['name'],
                       'description' => utf8_substr(strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
                       'href'        => $product['link']
                   );
               }
            }
        }

		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        $data['quote'] = $this->load->controller('module/quote');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/hotsale.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/hotsale.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/hotsale.tpl', $data));
		}
	}
}