<?php
class ControllerCommonDocuments extends Controller {
    /**
     *
     */
    public function index() {
		$this->document->setTitle("Documents");
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));
        $data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => $this->url->link('common/home')
        );
        $data['breadcrumbs'][] = array(
            'text' => 'Documents',
            'href' => $this->url->link('common/documents')
        );

        $downloads = $this->db->query("select a.download_id,a.mask,b.name,a.category_id from oc_download a LEFT JOIN oc_download_description b ON a.download_id = b.download_id");
        $downloads = $downloads->rows;
        $download_category= $this->db->query("select * from oc_download_category order by sort_order asc");
        $download_category = $download_category->rows;
        $data['documents'] = array();
        foreach($download_category as $k=>$category){
            $data['documents'][$k]['document_id'] = $category['download_id'];
            $data['documents'][$k]['name'] = $category['name'];
            foreach($downloads as $download){
               if($category['download_id'] == $download['category_id']){
                   $data['documents'][$k]['dowloads'][] = $download;
               }
            }
        }

		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/documents.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/documents.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/documents.tpl', $data));
		}
	}
}