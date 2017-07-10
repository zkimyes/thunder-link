<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/19
 * Time: 22:13
 */


class ControllerProductIndex extends Controller {

    public function index() {
        $this->load->language('product/product');
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => $this->url->link('common/home')
        );
        $data['breadcrumbs'][] = array(
            'text' => 'Products',
            'href' => $this->url->link('product/index')
        );

        $this->load->model('tool/image');
        $this->load->model('catalog/category');


        $categorys_info = $this->model_catalog_category->getCategories(0);
        if(!empty($categorys_info)){
            foreach($categorys_info as $catagory){
                if(!empty($catagory['image']) && file_exists(DIR_IMAGE.$catagory['image'])){
                    $image = $this->model_tool_image->resize($catagory['image'], 260, 260);
                }else{
                    $image = $this->model_tool_image->resize('placeholder.png', 260, 260);
                }
                $href = $this->url->link('product/category','&path='.$catagory['category_id'],'SSL');
                $data['categorys_info'][] = array(
                    'name'=>$catagory['name'],
                    'description'=>utf8_substr(strip_tags(html_entity_decode($catagory['description'], ENT_QUOTES, 'UTF-8')), 0, 1000) . '..',
                    'image'=>$image,
                    'href'=>$href
                );
            }

        }

        $this->document->setTitle("Huawei Optical Network Products - Thunder-link.com");
        $this->document->setDescription("Huawei Transmission, Huawei Access network, Huawei Datacommunication");
        $this->document->setKeywords("Thunder-link.com supply Huawei Optical Network Products, Huawei transmission network, Access Network, Switch, Router, Firewall");
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/index.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/index.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/product/index.tpl', $data));
        }

    }
}