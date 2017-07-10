<?php
class ControllerServiceIndex extends Controller {

    private $infoMenu = array(
        'AboutUs'=>'About Us',
        'HowToBuy'=>'How to Buy',
        'TechnicalSupport'=>'Technical Support',
        'CustomerService'=>'Customer Service'
    );


	public function index() {
		$this->load->language('information/information');
		$this->load->model('catalog/information');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => "Home",
			'href' => $this->url->link('common/home')
		);

        if(isset($this->request->get['information_id'])){
            $data['information_id'] = $this->request->get['information_id'];
            $data['information'] = $this->model_catalog_information->getInformation($data['information_id']);
            $data['breadcrumbs'][] = array(
                'text' => $data['information']['title'],
                'href' => $this->url->link('information/information', 'information_id='.$data['information']['information_id'])
            );
        }else{
            $informations = $this->model_catalog_information->getInformations();
            $data['information_id'] = $informations[0]['information_id'];
            $data['information'] = $informations[0];
            $data['breadcrumbs'][] = array(
                'text' => $informations[0]['title'],
                'href' => $this->url->link('information/information', 'information_id='.$informations[0]['information_id'])
            );
        }



        $this->document->setTitle("");
        $this->document->setDescription("");
        $this->document->setKeywords("");


        $data['continue'] = $this->url->link('common/home');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $data['menus'] = array();
        foreach($this->infoMenu as $k=>$v){
            $infos = $this->db->query("select oc_information.information_id,oc_information_description.title from oc_information LEFT JOIN oc_information_description on oc_information.information_id=oc_information_description.information_id WHERE oc_information.categroy = '".$k."'");
            $list = array();
            if(!empty($infos->rows)){
                foreach($infos->rows as $c=>$row){
                    $list[$c] =  array(
                        'url'=>$this->url->link('service/index/index','information_id='.$row['information_id']),
                        'title'=>$row['title']
                    );
                }
            }
            $data['menus'][$k]['name'] = $k;
            $data['menus'][$k]['list'] = $list;
        }


        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/service/index.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/service/index.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/service/index.tpl', $data));
        }
	}

}