<?php
class ControllerPromotionSet extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('setting/setting');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');
		$this->load->model('promotion/promotion');
		$data['heading_title'] = 'Promotion';

		$page = 1;
		$promotions_total = $this->model_promotion_promotion->getTotal();

		$pagination = new Pagination();
		$pagination->total = $promotions_total->row['count'];
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('design/banner', 'token=' . $this->session->data['token']);
		$data['pagomation'] = $pagination->render();

		$promotions = $this->model_promotion_promotion->getList($page);
		
		$data['lists'] = $promotions;
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('promotion/list', $data));
    }


	public function form(){
		$this->response->setOutput($this->load->view(''))
	}
}
