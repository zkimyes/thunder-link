<?php
class ControllerCommonDocument extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		$document_category = $this->db->query('select * from oc_document_category');
		$data['document_category'] = $document_category->rows;
		foreach ($data['document_category'] as &$category) {
			$category['link'] = $this->url->link('common/document/index','id='.$category['id']);
		}

		if(!empty($this->request->get['id'])){
			$data['id'] = $this->request->get['id'];
		}else{
			$data['id'] = 0;
		}
		$data['documents'] = [];
		if(!empty($data['id'])){
			$data['documents'] = $this->db->query('select * from oc_documents where category_id='.(int)$data['id']);
			$data['documents'] = $data['documents']->rows;
			foreach ($data['documents'] as &$value) {
				$value['link'] = $this->url->link('common/document/download','download_id='.$value['download_id']);
			}
		}
		$data['index_link'] = $this->url->link('common/document/index');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');


		$this->load->model('hotsale/products');
		$this->load->model('promotion/promotion');
		$this->load->model('support/article');
		$this->load->model('design/banner');


		$this->response->setOutput($this->load->view('common/document', $data));
	}

	 public function download() {
		$this->load->model('account/download');

		if (isset($this->request->get['download_id'])) {
			$download_id = $this->request->get['download_id'];
		} else {
			$download_id = 0;
        }

        $download_info = $this->db->query('select * from oc_download where download_id='.(int)$download_id);
        $download_info = $download_info->row;
		if ($download_info) {
			$file = DIR_DOWNLOAD . $download_info['filename'];
			$mask = basename($download_info['mask']);

			if (!headers_sent()) {
				if (file_exists($file)) {
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename="' . ($mask ? $mask : basename($file)) . '"');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					header('Content-Length: ' . filesize($file));

					if (ob_get_level()) {
						ob_end_clean();
					}

					readfile($file, 'rb');

					exit();
				} else {
					exit('Error: Could not find file ' . $file . '!');
				}
			} else {
				exit('Error: Headers already sent out!');
			}
		}
	}
}