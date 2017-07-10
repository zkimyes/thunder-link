<?php
class ControllerAboutusIndex extends Controller {



	public function index() {
		$this->load->language('information/information');
		$this->load->model('catalog/information');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => "Home",
			'href' => $this->url->link('common/home')
		);

        $data['breadcrumbs'][] = array(
            'text' => "About Us",
            'href' => $this->url->link('aboutus/index')
        );


        if(isset($this->request->get['information_id'])){
            $data['information_id'] = $this->request->get['information_id'];
            $data['information'] = $this->model_catalog_information->getInformation($data['information_id']);
            $data['breadcrumbs'][] = array(
                'text' => $data['information']['title'],
                'href' => $this->url->link('aboutus/index', 'information_id='.$data['information']['information_id'])
            );
            $this->document->setTitle($data['information']['meta_title']);
            $this->document->setDescription($data['information']['meta_description']);
            $this->document->setKeywords($data['information']['meta_keyword']);
        }else{
            $informations = $this->db->query("select b.title,b.meta_description,b.information_id,b.description,b.meta_keyword,b.meta_keyword,b.meta_title from oc_information a LEFT JOIN oc_information_description b ON a.information_id = b.information_id LEFT JOIN oc_information_category c ON c.category_id=a.categroy WHERE c.type=1 order by a.sort_order asc");
            $informations = $informations->rows;
            if(!empty($informations)){
                $data['information_id'] = $informations[0]['information_id'];
                $data['information'] = $informations[0];
                $data['breadcrumbs'][] = array(
                    'text' => $informations[0]['title'],
                    'href' => $this->url->link('aboutus/index', 'information_id='.$informations[0]['information_id'])
                );
                $this->document->setTitle($data['information']['meta_title']);
                $this->document->setDescription($data['information']['meta_description']);
                $this->document->setKeywords($data['information']['meta_keyword']);
            }

        }


        $data['continue'] = $this->url->link('common/home');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $data['menus'] = $this->db->query("select * from oc_information_category WHERE `type`= 1  ORDER BY sort_order asc");
        foreach($data['menus']->rows as &$v){
            $infos = $this->db->query("select oc_information.information_id,oc_information_description.title,oc_information.categroy from oc_information LEFT JOIN oc_information_description on oc_information.information_id=oc_information_description.information_id WHERE oc_information.categroy = '".$v['category_id']."' order by oc_information.sort_order asc");
            $list = array();
            if(!empty($infos->rows)){
                foreach($infos->rows as $c=>$row){
                    $list[$c] =  array(
                        'categroy'=>$row['information_id'],
                        'url'=>$this->url->link('aboutus/index','information_id='.$row['information_id']),
                        'title'=>$row['title']
                    );
                }
            }
            $v['list'] = $list;
        }
        $data['menus'] = $data['menus']->rows;
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/aboutus/index.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/aboutus/index.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/aboutus/index.tpl', $data));
        }
	}


}