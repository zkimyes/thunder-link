<?php
class ControllerSupportCategory extends Controller {
    public function index() {
        $this->document->setTitle($this->config->get('config_meta_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->setKeywords($this->config->get('config_meta_keyword'));
        $this->document->addLink('/catalog/view/theme/default/stylesheet/support.css','stylesheet');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = null;
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['search_action'] = $this->url->link('support/index');
        
        $this->load->model('support/category');
        $this->load->model('support/article');
		$data['is_hot_tags'] = $this->model_support_article->getIsHotTags(); 
        $categories = $this->model_support_category->getList('',"id,title,parent_id");
        $parents = [];
        $childs = [];
        
        foreach($categories as $category){
            if($category['parent_id'] == 0){
                $parents[] = $category;
            }else{
                $childs[] = $category;
            }
        }
        
        foreach($parents as &$parent){
			$parent['url'] = $this->url->link('support/category','id='.$parent['id']);
            foreach($childs as $child){
                if($parent['id'] == $child['parent_id']){
                    $child['url'] = $this->url->link('support/category','id='.$child['id']);
                    $parent['child'][] = $child;
                }
            }
        }
        
        $data['sider_categories'] = $parents;
        
        if(isset($this->request->get['id']) && !empty($this->request->get['id'])){
            $category_id = $this->request->get['id'];
        }else{
            $category_id = 0;
        }
        
        $result = $this->model_support_article->getArticleByCategoryId($category_id);
        foreach($result as $k=>$r){
            $data['result'][$k] = [
				'id'=>$r['id'],
				'title'=>strip_tags(htmlentities($r['title'])),
				'summary'=>strip_tags(htmlentities($r['summary'])),
				'tags'=>explode(',',$r['tags']),
				'url'=>$this->url->link('support/article','id='.$r['id'])
            ];

			if(!empty($r['image']) && is_file(DIR_IMAGE . $r['image'])){
                $data['result'][$k]['thumb'] =  $this->model_tool_image->resize($r['image'], 180, 220);
            }else {
                $data['result'][$k]['thumb'] = $this->model_tool_image->resize('no_image.png', 180, 220);
            }
        }
        
        $this->response->setOutput($this->load->view('support/category', $data));
    }
}