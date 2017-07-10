<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/12
 * Time: 22:23
 */

class ControllerConfigIndex extends Controller{

    public function index(){
        $this->document->addStyle('catalog/view/javascript/slick/slick.css');
        $this->document->addStyle('catalog/view/javascript/slick/slick-theme.css');
        $this->document->addScript('catalog/view/javascript/slick/slick.min.js');
        $this->load->model('catalog/product');
        $this->load->model('localisation/country');
        $this->load->model('tool/image');

        $data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => $this->url->link('common/home')
        );
        $data['breadcrumbs'][] = array(
            'text' => 'CONFINGURATION',
            'href' => $this->url->link('config/index')
        );
        $this->load->model('catalog/category');
        //找到一级目录 //两个整机目录
        $cates = $this->db->query("select category_id from oc_category WHERE mower=1 AND status = 1 AND parent_id = 0");
        $pid = array();
        foreach($cates->rows as $cate){
            $pid[] = $cate['category_id'];
        }
        $pid = implode(",",$pid);
        $cates_two = $this->db->query("select oc_category.category_id,oc_category_description.name,oc_category.parent_id from oc_category LEFT JOIN oc_category_description ON oc_category_description.category_id = oc_category.category_id WHERE find_in_set(oc_category.parent_id,'".$pid."') and oc_category.status=1 and oc_category.mower=1 order by sort_order asc");
        $cates_two = $cates_two->rows;
        $data['category_sublings'] = $cates_two;
        if(isset($this->request->get['category_id'])){
            $category_id = (int)$this->request->get['category_id'];
        }elseif(isset($this->request->get['product_id'])){
           $category_id = $this->db->query("select * from oc_config_category WHERE category_id=".(int)$this->request->get['product_id']);
            $category_id = $category_id->row['link_category'];
        }else{
            $category_id = $cates_two[0]['category_id'];
        }
        //二级目录
        foreach($data['category_sublings'] as &$ca){
            if($category_id == $ca['category_id']){
                $ca['active'] = true;
            }else{
                $ca['active'] = false;
            }
            $ca['href'] = $this->url->link("config/index","&category_id=".$ca['category_id']);
        }

        //当前的category信息
        $category_info = $this->model_catalog_category->getCategory($category_id);
        if ($category_info) {
            $data['breadcrumbs'][] = array(
                'text' => $category_info['name'],
                'href' => $this->url->link('config/index', 'category_id=' . $category_id)
            );
        }


        //当前目录下得config

        $data['products'] =  $this->db->query("select * from oc_config_category WHERE link_category=".$category_id." and oc_config_category.status=1 order by sort_order asc");
        $data['products'] = $data['products']->rows;
        if($data['products']){
            $data['products'] = array_values($data['products']);
            if(isset($this->request->get['product_id'])){
                $product_id = $this->request->get['product_id'];
            }else{
                $product_id = $data['products'][0]['category_id'];
            }
            //装配config_category的数据
            foreach($data['products'] as &$v){
                if($product_id == $v['category_id']){
                    $v['active'] = true;
                }else{
                    $v['active'] = false;
                }
                $v['href'] = $this->url->link('config/index',"&product_id=".$v['category_id']);
            }

            $nowproduct = $this->db->query("select * from oc_config_category WHERE category_id =".$product_id);//因为config categroy对应的就是产品所以这里的product_id 其实是config category 的category_id
            $nowproduct = $nowproduct->row;
            if($nowproduct){
                //当前产品
                $data['breadcrumbs'][] = array(
                    'text' => $nowproduct['name'],
                    'href' => $this->url->link('config/index', '&product_id='.$product_id)
                );
            }

            //解决方案
            $data['nowcategory'] = $nowproduct;

            if ($nowproduct['banner']) {
                $this->load->model('design/banner');
                $results = $this->model_design_banner->getBanner($nowproduct['banner']);
                $data['banner'] = array(
                    'title' => $results[0]['title'],
                    'link'  => $results[0]['link'],
                    'description'=> $results[0]['description'],
                    'image' => $this->model_tool_image->resize($results[0]['image'], 1900, 300)
                );
            } else {
                $data['banner'] = array(
                    'title' => "",
                    'link'  => "",
                    'description'=> "",
                    'image' => ""
                );
            }




            $data['plans'] = $this->db->query("select * from oc_config_plans WHERE category_id=".(int)$nowproduct['category_id']." order by sort_order desc");
            $data['plans'] = $data['plans']->rows;
            if(!empty($data['plans'])){
                foreach($data['plans'] as &$plan){
                    $plan = array(
                        'name'=>$plan['name'],
                        'description'=>$plan['description'],
                        'quote_description'=>$plan['quote_description'],
                        'thumb'=>$this->model_tool_image->resize($plan['image'], 260, 260),
                        'link'=>$this->url->link("product/product","&product_id=".$plan['link_product_id'])
                    );
                }
            }else{
                $data['plans'] = null;
            }
            if(!empty($nowproduct['boards'])){
                $data['items'] = $this->db->query("select a.`name`,a.filter_id from oc_filter_description a LEFT JOIN oc_filter b ON a.filter_id = b.filter_id WHERE a.filter_id in (".$nowproduct['boards'].") order by b.sort_order asc"); //筛选条件1
                $data['items'] =  $data['items']->rows;
            }else{
                $data['items'] =  array();
            }


            //按照 filter的order规则排序
            foreach($data['items'] as &$v){
                if(!empty($v['filter_id'])){
                    $related_product = $this->db->query("SELECT * from oc_product_filter LEFT JOIN oc_product_description ON oc_product_description.product_id = oc_product_filter.product_id WHERE oc_product_filter.product_id in (SELECT DISTINCT(product_id) FROM oc_product_filter WHERE filter_id=".(int)$nowproduct['items'].") AND oc_product_filter.filter_id =".(int)$v['filter_id']);
                    //$related_product = $this->db->query("select DISTINCT(oc_product_description.product_id),oc_product_description.`name`,oc_product_description.description,oc_product_filter.filter_id from oc_product_description left join oc_product_filter on oc_product_filter.product_id = oc_product_description.product_id where oc_product_filter.filter_id in (".$nowproduct['boards'].") AND oc_product_filter.filter_id=".(int)$nowproduct['items']);
                    //$related_product = $this->db->query("select DISTINCT(oc_product_description.product_id),oc_product_filter.filter_id from oc_product_description left join oc_product_filter on oc_product_filter.product_id = oc_product_description.product_id where oc_product_filter.filter_id in (".$nowproduct['boards'].")");
                    //foreach($related_product->rows as $product){
                    //     $r = $this->db->query("select * from oc_product_filter WHERE product_id =".$product['product_id']." AND  filter_id=".(int)$nowproduct['items']);
                    // }
                    $v['related_product'] = $related_product->rows;
                }
            }


            $data['selecte_intro'] = $nowproduct['main_intro'];

            $this->document->setTitle($nowproduct['meta_title']);
            $this->document->setDescription($nowproduct['meta_description']);
            $this->document->setKeywords($nowproduct['meta_keyword']);
        }else{
            $this->document->setTitle($category_info['meta_title']);
            $this->document->setDescription($category_info['meta_description']);
            $this->document->setKeywords($category_info['meta_keyword']);

            $data['plans'] = null;
            $data['items'] = null;
            $data['nowcategory'] = null;
            $data['banner'] = array(
                'title' => "",
                'link'  => "",
                'description'=> "",
                'image' => ""
            );
        }

        $data['contries'] = $this->model_localisation_country->getCountries();
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['quote'] = $this->load->controller('module/home_quote');
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/config/index.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/config/index.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/config/index.tpl', $data));
        }
    }

}


