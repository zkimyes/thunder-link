<?php
/**
* 客户支持文章管理
*/
class ControllerSupportTag extends Controller{
    public function index(){
        $this->document->setTitle("Tags List");
        
        $data['breadcrumbs'][] = [
        'text'=>'Home',
        'href'=>$this->url->link('commom/dashboard','token='.$this->session->data['token'])
        ];
        $data['breadcrumbs'][] = [
        'text'=>'Support Tags',
        'href'=>'javascript:;'
        ];
        
        $this->getList($data);
    }
    
    public function delete(){
        $this->load->model('support/article');
        if (isset($this->request->post['selected'])) {
            $this->model_support_article->delt($this->request->post['selected']);
            $this->response->jsonOutput([
            'status'=>'1',
            'info'=>'success'
            ]);
        }else{
            $this->response->jsonOutput([
            'status'=>'0',
            'info'=>'no item to delete'
            ]);
        }
    }
    
    
    public function add(){
        $this->load->model('support/article');
        $data['submit_url'] = $this->url->link('support/article/add');
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_support_article->add($post);
            $this->response->jsonOutput($rs);
        }else{
            $data['breadcrumbs'][] = [
            'text'=>'Home',
            'href'=>$this->url->link('commom/dashboard','token='.$this->session->data['token'])
            ];
            $data['breadcrumbs'][] = [
            'text'=>'Solution Article Add',
            'href'=>'javascript:;'
            ];
            $data['product_relateds'] = [];
            $this->form($data);
        };
    }
    
    public function update(){
        $this->load->model('support/article');
        $this->load->model('catalog/product');
        $data['submit_url'] = $this->url->link('support/article/update');
        $data['breadcrumbs'][] = [
        'text'=>'Home',
        'href'=>$this->url->link('commom/dashboard','token='.$this->session->data['token'])
        ];
        $data['breadcrumbs'][] = [
        'text'=>'Solution Article Update',
        'href'=>''
        ];
        if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
            $post = $this->request->post;
            $rs = $this->model_support_article->update($post);
            $this->response->jsonOutput($rs);
        }else{
            $id = $this->request->get['id'];
            if(!empty($id)){
                $article = $this->model_support_article->find($id);
            }
            $data['article'] = $article;
            $data['product_relateds'] = [];
            if(!empty($article['related_product_ids'])){
                $related_info = $this->model_catalog_product->getProductsByProductIds($article['related_product_ids']);
                $data['product_relateds'] = $related_info;
            }
            $this->form($data);
        };
    }
    
    
    protected function form($data){
        $this->load->model('support/category');
        $this->load->model('design/banner');
        $data['categorys'] = $this->model_support_category->getList();
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $data['back_url'] = $this->url->link('support/article/index');
        $data['token'] = $this->session->data['token'];
        if (!empty($data['article']['image']) && is_file(DIR_IMAGE . $data['article']['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($data['article']['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

        $data['banners'] = $this->model_design_banner->getBanners();

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


        $this->response->setOutput($this->load->view('support/article_form', $data));
    }
    
    
    protected function getList($data) {
        $url = '';
        $token = $this->session->data['token'];
        if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
        $data['url'] = $this->url;
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $data['add_url'] = $this->url->link('support/tag/add');
        $data['update_url'] = $this->url->link('support/tag/update');
        $data['delt_url'] = $this->url->link('support/tag/delete');
        
        $this->load->model('support/tag');
        $data['lists'] = $this->model_support_tag->getList([],"","",(int)$page);
        $total = $this->model_support_tag->getTotalTags();
        $pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = 12;
		$pagination->url = $this->url->link('support/tag', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();
        $data['token'] = $token;
        $this->response->setOutput($this->load->view('support/tag_list', $data));
    }


    public function ajaxGetTagByName(){
        $name = $this->request->get['name'];
        $this->load->model('support/tag');
        if(!empty($name)){
            $tags = $this->model_support_tag->findByName($name);
            $this->response->jsonOutput($tags);
        }else{
            $this->response->jsonOutput(false);
        }
    }

    public function ajaxAddTag(){
        $name = $this->request->post['name'];
        $this->load->model('support/tag');
        if(!empty($name)){
            $res = $this->model_support_tag->add(['name'=>$name]);
            if($res){
                $id = $this->db->getLastId();
                $this->response->jsonOutput([
                    'id'=>$id,
                    'msg'=>'succ'
                ]);
            }else{
                $this->response->jsonOutput(false);
            }
            
        }
    }
}