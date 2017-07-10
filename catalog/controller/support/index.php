<?php
class ControllerSupportIndex extends Controller {

    public function index() {

        $this->document->setTitle("Huawei Optical Network Products Technical Support Article and Case Study - Thunder-link.com");
        $this->document->setDescription("Technical support for Huawei network products, find guidebook on upgrade, hardware compatibility, experience sharing at Thunder-link.com");
        $this->document->setKeywords("Huawei product technical support, case study, experience sharing");
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => "Home",
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => "Support",
            'href' => $this->url->link('support/index')
        );
        $this->load->model('tool/image');
        $data['menus'] = $this->db->query("select * from oc_information_category WHERE `type`= 2  ORDER BY sort_order asc");
        foreach($data['menus']->rows as &$v){
            $inforcount = $this->db->query("select count(*) as count from oc_information WHERE oc_information.categroy = '".$v['category_id']."'");
            $v['nub'] = $inforcount->row['count'];
            $v['link'] = $this->url->link('support/index/category','&category_id='.$v['category_id']);
            if (!empty($v) && is_file(DIR_IMAGE . $v['banner'])) {
                $v['thumb'] = $this->model_tool_image->resize($v['banner'], 190, 135);
            } else {
                $v['thumb'] = $this->model_tool_image->resize('no_image.png', 190, 135);
            }
        }

        $data['menus'] = $data['menus']->rows;


        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/support/home.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/support/home.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/support/home.tpl', $data));
        }
    }

	public function category() {

		$this->load->language('information/information');
		$this->load->model('catalog/information');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => "Home",
			'href' => $this->url->link('common/home')
		);

        $data['breadcrumbs'][] = array(
            'text' => "Support",
            'href' => $this->url->link('support/index')
        );

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $data['menus'] = $this->db->query("select * from oc_information_category WHERE `type`= 2  ORDER BY sort_order asc");
        foreach($data['menus']->rows as &$v){
            $inforcount = $this->db->query("select count(*) as count from oc_information WHERE oc_information.categroy = '".$v['category_id']."'");
            $v['nub'] = $inforcount->row['count'];
            $v['link'] = $this->url->link('support/index/category','&category_id='.$v['category_id']);
        }
        $data['menus'] = $data['menus']->rows;


        if(isset($this->request->get['category_id']) && !empty($this->request->get['category_id'])){
            $category_id = $this->request->get['category_id'];
            $category_info = $this->db->query("select * from oc_information_category WHERE category_id=".(int)$category_id);
            $this->document->setTitle($category_info->row['meta_title']);
            $this->document->setDescription($category_info->row['meta_description']);
            $this->document->setKeywords($category_info->row['meta_keyword']);
            $data['breadcrumbs'][] = array(
                'text' => $category_info->row['name'],
                'href' => $this->url->link('support/index/category', '&category_id='.$category_info->row['category_id'])
            );
        }else{
            $category_id =  $data['menus'][0]['category_id'];
            $this->document->setTitle($data['menus'][0]['meta_title']);
            $this->document->setDescription($data['menus'][0]['meta_description']);
            $this->document->setKeywords($data['menus'][0]['meta_keyword']);
            $data['breadcrumbs'][] = array(
                'text' => $data['menus'][0]['name'],
                'href' => $this->url->link('support/index/category', '&category_id='.$data['menus'][0]['category_id'])
            );
        }

        $category_id = (int)$category_id;

        $data['category_id'] = $category_id;


        $limit = 1;
        $start =($page - 1) * $limit;

        $informations = $this->db->query("select b.title,b.meta_description,b.information_id,b.description,b.meta_keyword,b.meta_keyword,b.meta_title from oc_information a LEFT JOIN oc_information_description b ON a.information_id = b.information_id  WHERE a.categroy=".(int)$category_id." limit ".$start.",".$limit);
        $informations = $informations->rows;
        $informationcount = $this->db->query("select count(*) as count from oc_information WHERE categroy=".(int)$category_id);

        $data['informations'] = array();
        foreach($informations as $information){
            $data['informations'][]=array(
                'title'=>$information['title'],
                'description'=>utf8_substr(strip_tags(html_entity_decode($information['description'], ENT_QUOTES, 'UTF-8')), 0, 300) . '..',
                'link'=>$this->url->link('support/index/detail','&information_id='.(int)$information['information_id'])
            );
        }



        $pagination = new Pagination();
        $pagination->total = $informationcount->row['count'];
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->url = $this->url->link('/support/index/category&page={page}',"&category_id=".$category_id);

        $data['pagination'] = $pagination->render();


        $data['continue'] = $this->url->link('common/home');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/support/index.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/support/index.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/support/index.tpl', $data));
        }
	}



    public function detail(){
        $this->load->model('catalog/information');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => "Home",
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => "Support",
            'href' => $this->url->link('support/index')
        );

        $data['menus'] = $this->db->query("select * from oc_information_category WHERE `type`= 2  ORDER BY sort_order asc");
        foreach($data['menus']->rows as &$v){
            $inforcount = $this->db->query("select count(*) as count from oc_information WHERE oc_information.categroy = '".$v['category_id']."'");
            $v['nub'] = $inforcount->row['count'];
            $v['link'] = $this->url->link('support/index/category','&category_id='.$v['category_id']);
        }
        $data['menus'] = $data['menus']->rows;

        if(isset($this->request->get['information_id'])){
            $support_id = $this->request->get['information_id'];
        }else{
            $support_id = 0;
        }

        $support_info = $this->model_catalog_information->getInformation($support_id);

        $this->document->setTitle($support_info['meta_title']);
        $this->document->setDescription($support_info['meta_description']);
        $this->document->setKeywords($support_info['meta_keyword']);

        $data['category_id'] = $support_info['categroy'];

        $category_info = $this->db->query("select * from oc_information_category WHERE category_id=".(int)$data['category_id']);
        $data['breadcrumbs'][] = array(
            'text' => $category_info->row['name'],
            'href' => $this->url->link('support/index/category', '&category_id='.$category_info->row['category_id'])
        );

        $data['breadcrumbs'][] = array(
            'text' => $support_info['title'],
            'href' => $this->url->link('support/index/detail', '&information_id='.$support_info['information_id'])
        );

        $data['information'] = $support_info;


        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/support/detail.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/support/detail.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/support/detail.tpl', $data));
        }
    }

}