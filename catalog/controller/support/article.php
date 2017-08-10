<?php
class ControllerSupportArticle extends Controller {
    public function index() {
        $this->document->addLink('/catalog/view/theme/default/stylesheet/support.css','stylesheet');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = null;
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['search_action'] = $this->url->link('support/index');
        
        $this->load->model('support/article');

        if(isset($this->request->get['id']) && !empty($this->request->get['id'])){
            $article = $this->model_support_article->viewArticle($this->request->get['id'],[]);
        }else{
            $article = null;
        }
         $data['article'] = $article?[
            'title'=>strip_tags(htmlentities($article['title'])),
            'content'=>htmlentities($article['title']),
        ]:null;
        $this->document->setTitle($this->config->get('config_meta_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->setKeywords($this->config->get('config_meta_keyword'));


        $this->response->setOutput($this->load->view('support/article', $data));
    }
}