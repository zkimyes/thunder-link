<?php
class ControllerHotSaleIndex extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('setting/setting');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
		$data = [];
		$this->response->setOutput($this->load->view('hot_sale/index', $data));
    }
}
