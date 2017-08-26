<?php
class ControllerAccountReviews extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/reviews', '', true);

			$this->response->redirect($this->url->link('account/login', '', true));
		}

		$this->document->setTitle('My Reviews');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'Home',
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Reviews',
			'href' => $this->url->link('account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_reward'),
			'href' => $this->url->link('account/reward', '', true)
		);

		$this->load->model('account/review');

		$data['heading_title'] = 'My Reviews';


		$data['text_total'] = 'Reviews';
		$data['text_empty'] = 'No Reviews';

		$data['button_continue'] = 'continue';

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$this->load->model('tool/image');
		$data['reviews'] = array();

		$filter_data = array(
			'customer_id'=> $this->customer->getId(),
			'sort'  => 'date_added',
			'order' => 'DESC',
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$reward_total = $this->model_account_review->getTotalReviews();

		$results = $this->model_account_review->getReviews($filter_data);
				
		foreach ($results as $result) {
			if(!empty($result['image']) && is_file(DIR_IMAGE . $result['image'])){
                $image =  $this->model_tool_image->resize($result['image'], 90, 90);
            }else {
                $image = $this->model_tool_image->resize('no_image.png', 90, 90);
            }
			$data['reviews'][] = [
				'review_id'=>$result['review_id'],
				'name'=>$result['name'],
				'text'=>$result['text'],
				'image'=>$image,
				'author'=>$result['author'],
				'rating'=>$result['rating'],
				'status'=>$result['status'],
				'date_added'=>$result['date_added'],
				'reply'=>$replys = $this->model_account_review->getReplyByReviewId($result['review_id'])				
			];
		}

		$pagination = new Pagination();
		$pagination->total = $reward_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('account/reward', 'page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($reward_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($reward_total - 10)) ? $reward_total : ((($page - 1) * 10) + 10), $reward_total, ceil($reward_total / 10));

		$data['total'] = (int)$this->customer->getRewardPoints();

		$data['continue'] = $this->url->link('account/account', '', true);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['reply_url'] = $this->url->link('account/reivew/reply','token='.$this->session->data['token']);

		$this->response->setOutput($this->load->view('account/reviews', $data));
	}

	public function replay(){
		if(isset($this->request->get['content']) && !empty($this->request->get['content'])){
			$data['content'] = $this->request->get['content'];
		}else{
			$data['content'] = '';
		}
		if(isset($this->request->get['review_id']) && !empty($this->request->get['review_id'])){
			$data['review_id'] = $this->request->get['review_id'];
		}else{
			$data['review_id'] = 0;
		}
		

		$this->load->model('account/customer');
		$this->load->model('account/review');

	}
}