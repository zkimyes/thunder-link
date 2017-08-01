<?php
class ControllerConfigureIndex extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));
		$this->document->addStyle('catalog/view/theme/default/stylesheet/configure.css');
		$this->document->addScript('catalog/view/javascript/app/configure.js');
		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = null;
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');



	   $data['config_typical'] = [
		   '0'=>[
			   'name'=>'asdasd',
			   'img-url'=>'/image/u672.png',
			   'parameters'=>[
				   '0'=>[
					   'name'=>'Speed',
					   'range'=>'40'
				   ],
				   '1'=>[
					   'name'=>'Distance',
					   'range'=>'50'
				   ],
				   '2'=>[
					   'name'=>'SFP',
					   'range'=>'66'
				   ],
				   '3'=>[
					   'name'=>'SDFDFDF',
					   'range'=>'30'
				   ]
			   ]
		   ],
		   '1'=>[
			   'name'=>'asdas213123213d',
			   'img-url'=>'/image/u672.png',
			   'parameters'=>[
				   '0'=>[
					   'name'=>'Speed',
					   'range'=>'40'
				   ],
				   '1'=>[
					   'name'=>'Distance',
					   'range'=>'50'
				   ],
				   '2'=>[
					   'name'=>'SFP',
					   'range'=>'66'
				   ],
				   '3'=>[
					   'name'=>'SDFDFDF',
					   'range'=>'30'
				   ]
			   ]
		   ],
		   '2'=>[
			   'name'=>'asdas213123213d',
			   'img-url'=>'/image/u672.png',
			   'parameters'=>[
				   '0'=>[
					   'name'=>'Speed',
					   'range'=>'40'
				   ],
				   '1'=>[
					   'name'=>'Distance',
					   'range'=>'50'
				   ],
				   '2'=>[
					   'name'=>'SFP',
					   'range'=>'66'
				   ],
				   '3'=>[
					   'name'=>'SDFDFDF',
					   'range'=>'30'
				   ]
			   ]
		   ]
	   ];


		$this->response->setOutput($this->load->view('configure/index', $data));
	}

}