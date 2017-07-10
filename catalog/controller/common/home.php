<?php
class ControllerCommonHome extends Controller {
    /**
     *
     */
    public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

        $this->document->addStyle('catalog/view/javascript/slick/slick.css');
        $this->document->addStyle('catalog/view/javascript/slick/slick-theme.css');
        $this->document->addScript('catalog/view/javascript/slick/slick.min.js');

		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}


        $this->load->model('tool/image');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        $data['quote'] = $this->load->controller('module/home_quote');

        $data['center_banner'] = $this->getCenterAds();
        $data['package_list'] = $this->getPackages();

        $data['hotsales'] = $this->getHotSale();

        $data['hotsalelink'] = $this->url->link("common/hotsale");

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
		}
	}



    private function getCenterAds(){
        $this->load->model('design/banner');
        $settingbannerid = array(
            'banner1'=>13,
            'banner2'=>14,
            'banner3'=>15,
            'banner4'=>16,
            'banner5'=>17
        );
        $banner1 = $this->model_design_banner->getBanner($settingbannerid['banner1']);
        $banner2 = $this->model_design_banner->getBanner($settingbannerid['banner2']);
        $banner3 = $this->model_design_banner->getBanner($settingbannerid['banner3']);
        $banner4 = $this->model_design_banner->getBanner($settingbannerid['banner4']);
        $banner5 = $this->model_design_banner->getBanner($settingbannerid['banner5']);
        $data['banner1'] = array(
            'title' => $banner1[0]['title'],
            'link'  => $banner1[0]['link'],
            'description'=> strip_tags(html_entity_decode($banner1[0]['description'])),
            'image' => $this->model_tool_image->resize($banner1[0]['image'], 370, 250)
        );
        $data['banner2'] = array(
            'title' => $banner2[0]['title'],
            'link'  => $banner2[0]['link'],
            'description'=> strip_tags(html_entity_decode($banner2[0]['description'])),
            'image' => $this->model_tool_image->resize($banner2[0]['image'], 370, 250)
        );
        $data['banner3'] = array(
            'title' => $banner3[0]['title'],
            'link'  => $banner3[0]['link'],
            'description'=> strip_tags(html_entity_decode($banner3[0]['description'])),
            'image' => $this->model_tool_image->resize($banner3[0]['image'], 370, 250)
        );
        $data['banner4'] = array(
            'title' => $banner4[0]['title'],
            'link'  => $banner4[0]['link'],
            'description'=> strip_tags(html_entity_decode($banner4[0]['description'])),
            'image' => $this->model_tool_image->resize($banner4[0]['image'], 774, 250)
        );
        $data['banner5'] = array(
            'title' => $banner5[0]['title'],
            'link'  => $banner5[0]['link'],
            'description'=> strip_tags(html_entity_decode($banner5[0]['description'])),
            'image' => $this->model_tool_image->resize($banner5[0]['image'], 370, 250)
        );

        return $data;
    }


    private function getPackages(){
        $this->load->model('package/package');
        $configcate = $this->db->query("select name,category_id from oc_config_category WHERE status=1 ORDER BY sort_order asc");
        $configcate = $configcate->rows;
        $packages = $this->model_package_package->getPackages();

        foreach($configcate as $s=>$config){
            foreach($packages as &$package){
                if($config['category_id'] == $package['config_category']){
                    $prodcuts = json_decode($package['detail'],true);
                    $product_ids = implode($prodcuts['product_id'],',');
                    $rows = $this->db->query("select oc_product.product_id,oc_product.model,oc_product.image,oc_product_description.name from oc_product LEFT join oc_product_description ON oc_product.product_id = oc_product_description.product_id WHERE oc_product.product_id IN (".$product_ids.")");
                    foreach($prodcuts['product_id'] as $e=>$product_id){
                        foreach($rows->rows as $k=>$row){
                            if($row['product_id'] == $product_id){
                                $package['products'][] = array(
                                    'name' => $row['name'],
                                    'link'  => $this->url->link('product/product','&product_id='.$row['product_id'],'SSL'),
                                    'model'=> $row['model'],
                                    'image' => $this->model_tool_image->resize($row['image'], 228, 180),
                                    'nub'   => $prodcuts['product_nub'][$e],
                                    'main_product' =>$package['main_product']
                                );
                            }
                        }
                    }
                    $configcate[$s]['packages'][] = $package;
                }
            }
        }
       return $configcate;
    }

    private function getHotSale(){
        $categorys = $this->db->query("select * from oc_hotsale_category WHERE home=1 ORDER BY sort_order asc");
        $categorys = $categorys->rows;
        $products= $this->db->query("select * from oc_hotsale_products WHERE home=1 order by sort_order asc");
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
        $hotsale = array();
        foreach($categorys as $k=>$category){
            $hotsale[$k]['name'] = $category['name'];
            foreach($products as $product){
                if($category['id'] == $product['hotsale_category']){
                    $hotsale[$k]['products'][] = $product;
                }
            }
        }
        return $hotsale;
    }

}