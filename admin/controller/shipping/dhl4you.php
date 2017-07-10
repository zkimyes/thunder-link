<?php
class ControllerShippingDhl4You extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('shipping/dhl4you');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('dhl4you', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_none'] = $this->language->get('text_none');

		$data['entry_total'] = $this->language->get('entry_total');
		$data['text_help_small'] = $this->language->get('text_help_small');
		$data['text_help_large'] = $this->language->get('text_help_large');
		$data['text_help_germany'] = $this->language->get('text_help_germany');
		$data['text_help_europe'] = $this->language->get('text_help_europe');
		$data['text_help_world'] = $this->language->get('text_help_world');

		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');


		$data['entry_small_cost'] = $this->language->get('entry_small_cost');
		$data['entry_large_cost'] = $this->language->get('entry_large_cost');
		$data['entry_germany_cost'] = $this->language->get('entry_germany_cost');
		$data['entry_westeurope_cost'] = $this->language->get('entry_westeurope_cost');
		$data['entry_europe_cost'] = $this->language->get('entry_europe_cost');
		$data['entry_world_cost'] = $this->language->get('entry_world_cost');

		$data['entry_use_freeshipping'] = $this->language->get('entry_use_freeshipping');
		$data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['help_use_freeshipping'] = $this->language->get('help_use_freeshipping');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_netherlands'] = $this->language->get('tab_netherlands');
		$data['tab_germany'] = $this->language->get('tab_germany');
		$data['tab_europe'] = $this->language->get('tab_europe');
		$data['tab_world'] = $this->language->get('tab_world');

		$data['text_countries_westeurope'] = $this->language->get('text_countries_westeurope');
		$data['text_countries_europe'] = $this->language->get('text_countries_europe');
		$data['text_countries_world'] = $this->language->get('text_countries_world');
		$data['text_countries_customs'] = $this->language->get('text_countries_customs');


 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

  		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
      		//'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_shipping'),
			'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
      		//'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('shipping/dhl4you', 'token=' . $this->session->data['token'], 'SSL'),
      		//'separator' => ' :: '
   		);

		$data['action'] = $this->url->link('shipping/dhl4you', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');

		// Netherlands
		if (isset($this->request->post['dhl4you_small_cost'])) {
			$data['dhl4you_small_cost'] = $this->request->post['dhl4you_small_cost'];
		} else {
			$data['dhl4you_small_cost'] = $this->config->get('dhl4you_small_cost');
		}

		if (isset($this->request->post['dhl4you_large_cost'])) {
			$data['dhl4you_large_cost'] = $this->request->post['dhl4you_large_cost'];
		} else {
			$data['dhl4you_large_cost'] = $this->config->get('dhl4you_large_cost');
		}

		// Germany
		if (isset($this->request->post['dhl4you_germany_cost'])) {
			$data['dhl4you_germany_cost'] = $this->request->post['dhl4you_germany_cost'];
		} else {
			$data['dhl4you_germany_cost'] = $this->config->get('dhl4you_germany_cost');
		}

		// Western Europe - except Germany
		if (isset($this->request->post['dhl4you_westeurope_cost'])) {
			$data['dhl4you_westeurope_cost'] = $this->request->post['dhl4you_westeurope_cost'];
		} else {
			$data['dhl4you_westeurope_cost'] = $this->config->get('dhl4you_westeurope_cost');
		}

		// Rest of Europe - except Germany
		if (isset($this->request->post['dhl4you_europe_cost'])) {
			$data['dhl4you_europe_cost'] = $this->request->post['dhl4you_europe_cost'];
		} else {
			$data['dhl4you_europe_cost'] = $this->config->get('dhl4you_europe_cost');
		}

		// Rest of the World
		if (isset($this->request->post['dhl4you_world_cost'])) {
			$data['dhl4you_world_cost'] = $this->request->post['dhl4you_world_cost'];
		} else {
			$data['dhl4you_world_cost'] = $this->config->get('dhl4you_world_cost');
		}

		// Settings
		if (isset($this->request->post['dhl4you_use_freeshipping'])) {
			$data['dhl4you_use_freeshipping'] = $this->request->post['dhl4you_use_freeshipping'];
		} else {
			$data['dhl4you_use_freeshipping'] = $this->config->get('dhl4you_use_freeshipping');
		}

		if (isset($this->request->post['dhl4you_total'])) {
			$data['dhl4you_total'] = $this->request->post['dhl4you_total'];
		} else {
			$data['dhl4you_total'] = $this->config->get('dhl4you_total');
		}
		
		$this->load->model('localisation/tax_class');

		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post['dhl4you_geo_zone_id'])) {
			$data['dhl4you_geo_zone_id'] = $this->request->post['dhl4you_geo_zone_id'];
		} else {
			$data['dhl4you_geo_zone_id'] = $this->config->get('dhl4you_geo_zone_id');
		}

		if (isset($this->request->post['dhl4you_tax_class_id'])) {
			$data['dhl4you_tax_class_id'] = $this->request->post['dhl4you_tax_class_id'];
		} else {
			$data['dhl4you_tax_class_id'] = $this->config->get('dhl4you_tax_class_id');
		}
		
		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['dhl4you_status'])) {
			$data['dhl4you_status'] = $this->request->post['dhl4you_status'];
		} else {
			$data['dhl4you_status'] = $this->config->get('dhl4you_status');
		}

		if (isset($this->request->post['dhl4you_sort_order'])) {
			$data['dhl4you_sort_order'] = $this->request->post['dhl4you_sort_order'];
		} else {
			$data['dhl4you_sort_order'] = $this->config->get('dhl4you_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('shipping/dhl4you.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'shipping/dhl4you')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
?>