<?php
class ControllerSolutionIndex extends Controller{
    public function index(){
        $this->document->setTitle($this->config->get('config_meta_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->setKeywords($this->config->get('config_meta_keyword'));
        
        $this->document->addStyle('catalog/view/theme/default/stylesheet/solution.css');
        
        
        $this->load->model('solution/category');
        $this->load->model('solution/article');
        $this->load->model('tool/image');
        $data['solution_categoris'] = $this->model_solution_category->getCategoris();
        if(isset($this->request->get['category_id']) && !empty($this->request->get['category_id'])){
            $data['get_id'] = $this->request->get['category_id'];
        }else{
            $data['get_id'] = $data['solution_categoris'][0]['id'];
        }
        foreach($data['solution_categoris'] as &$category){
            $category['link'] = $this->url->link('solution/index','category_id='.$category['id']);
        }
        $data['articles'] = $this->model_solution_article->getList($data['get_id']);
        foreach($data['articles'] as &$article){
            if(!empty($article['image']) && is_file(DIR_IMAGE . $article['image'])){
                $article['thumb'] =  $this->model_tool_image->resize($article['image'], 140, 115);
            }else {
                $article['thumb'] = $this->model_tool_image->resize('no_image.png', 140, 115);
            }
            $article['summary'] = utf8_substr(strip_tags(html_entity_decode($article['summary'], ENT_QUOTES, 'UTF-8')), 0, 150) . '..';
            $article['link'] = $this->url->link('solution/article','id='.$article['id']);
        }
        $data['solution_category'] = $this->model_solution_category->getList();
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = null;
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('solution/index', $data));
    }
}


function returnCid($v){
    return $v['id'];
}