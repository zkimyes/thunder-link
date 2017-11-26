<?php
/**
 * 文档管理
 */
class ControllerCommonDocument extends Controller {
	public function index() {
		$this->document->addScript('/admin/view/javascript/vue/vue.min.js');
		$data['title'] = "文档分类列表";
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$data['cols'] = [
			'ID',
			'Name'
		];
		$categories = $this->getList();
		$data['categories'] = json_encode($categories['rows'],true);
		$data['total'] = $categories['total'];
		$data['delt_url'] = $this->url->link('common/document/delt','token='.$this->session->data['token']);
		$data['save_url'] = $this->url->link('common/document/add','token='.$this->session->data['token']);
        $this->response->setOutput($this->load->view('document/index', $data));
	}

	public function add(){
		$_post = $this->request->post;
		if(isset($_post['id']) && !empty($_post['id'])){
			$sql = 'update oc_document_category set name="'.$this->db->escape($_post['name']).'" where id ='.(int)$_post['id'];
			$result = $this->db->query($sql);
		}else{
			$sql = 'insert into oc_document_category set name="'.$this->db->escape($_post['name']).'"';
			$result = $this->db->query($sql);
		}
		if($result){
			$this->ajaxReturn([
				'msg'=>'success',
				'data'=>''
			]);
		}
	}


	public function delt(){
		if(isset($this->request->post['id']) && !empty($this->request->post['id'])){
			$id = $this->request->post['id'];
		}else{
			$id = null;
		}
		$return = [
			'msg'=>'删除失败',
			'data'=>''
		];
		if($id){
			$sql = 'delete from oc_document_category where id ='.(int)$id;
			$result = $this->db->query($sql);
			if($result){
				$return = [
					'msg'=>'删除成功',
					'data'=>''
				];
			}
		}
		$this->response->ajaxReturn($return);
	}


	/**
	 * 获取列表
	 * @return void
	 */
	private function getList(){
		if(isset($this->request->get['page']) && !empty($this->request->get['page'])){
			$page = $this->request->get['page']<=1?1:$this->request->get['page'];
		}else{
			$page = 1;
		}
		
		$sql = 'select *,(select count(*) as total from `oc_document_category`) as total from oc_document_category';
		$result = $this->db->query($sql);
		return [
			'rows'=>$result->rows,
			'total'=>$result->row['total']
		];
	}


	public function doc_list(){
		$this->document->addScript('/admin/view/javascript/vue/vue.min.js');
		$data['title'] = "文档列表";
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$data['cols'] = [
			'ID',
			'Name',
			'Category_Name',
			'Download_Id'
		];
		$documents = $this->getDocList();
		$data['documents'] = json_encode($documents['rows'],true);
		$data['total'] = $documents['total'];
		$categories = $this->getList();
		$data['categories'] = json_encode($categories['rows'],true);
		$data['delt_url'] = $this->url->link('common/document/doc_delt','token='.$this->session->data['token']);
		$data['save_url'] = $this->url->link('common/document/doc_add','token='.$this->session->data['token']);
		$data['token'] = $this->session->data['token'];
        $this->response->setOutput($this->load->view('document/doc_index', $data));
	}



	public function doc_add(){
		$_post = $this->request->post;
		if(isset($_post['id']) && !empty($_post['id'])){
			$sql = 'update oc_documents set name="'.$this->db->escape($_post['name']).'",
					category_id = '.(int)$_post['category_id'].',
					download_id = '.(int)$_post['download_id'].'
				     where id ='.(int)$_post['id'];
			$result = $this->db->query($sql);
		}else{
			$sql = 'insert into oc_documents set name="'.$this->db->escape($_post['name']).'",
					category_id = '.(int)$_post['category_id'].',
					download_id = '.(int)$_post['download_id']
			;
			$result = $this->db->query($sql);
		}
		if($result){
			$this->response->ajaxReturn([
				'msg'=>'success',
				'data'=>''
			]);
		}
	}


	public function doc_delt(){
		if(isset($this->request->post['id']) && !empty($this->request->post['id'])){
			$id = $this->request->post['id'];
		}else{
			$id = null;
		}
		$return = [
			'msg'=>'删除失败',
			'data'=>''
		];
		if($id){
			$sql = 'delete from oc_document where id ='.(int)$id;
			$result = $this->db->query($sql);
			if($result){
				$return = [
					'msg'=>'删除成功',
					'data'=>''
				];
			}
		}
		$this->response->ajaxReturn($return);
	}


	/**
	 * 获取列表
	 * @return void
	 */
	private function getDocList(){
		if(isset($this->request->get['page']) && !empty($this->request->get['page'])){
			$page = $this->request->get['page']<=1?1:$this->request->get['page'];
		}else{
			$page = 1;
		}
		
		$sql = 'SELECT *,(SELECT name FROM oc_document_category c WHERE doc.`category_id` = c.id) AS category_name,
				(SELECT name oc_download_description where download_id = doc.download_id) as download_name,
				(SELECT count(*) FROM oc_documents) AS total
				FROM `oc_documents` AS doc;';
		$result = $this->db->query($sql);
		return [
			'rows'=>$result->rows,
			'total'=>$result->row['total']
		];
	}

}