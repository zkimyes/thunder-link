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
        $data['add_comments'] = $this->url->link('support/article/addComments');
        
        $this->load->model('support/article');

        if(isset($this->request->get['id']) && !empty($this->request->get['id'])){
            $article = $this->model_support_article->viewArticle($this->request->get['id'],[]);
        }else{
            $article = null;
        }
         $data['article'] = $article?[
            'id'=>$article['id'],
            'title'=>strip_tags(htmlentities($article['title'])),
            'content'=>htmlentities($article['title']),
            'is_comment' =>$article['is_comment']
        ]:null;

        if($article['is_comment'] == '1'){
            $this->load->model('support/comments');
            $data['comments'] = $this->model_support_comments->getCommentsByArticleId($article['id']);
        }
        $this->document->setTitle($this->config->get('config_meta_title'));
        $this->document->setDescription($this->config->get('config_meta_description'));
        $this->document->setKeywords($this->config->get('config_meta_keyword'));


        $this->response->setOutput($this->load->view('support/article', $data));
    }


    public function addComments(){
        if(isset($this->request->post['content']) && !empty($this->request->post['content'])){
            $this->load->model('support/comments');
            $this->model_support_comments->addComments([
                'article_id'=>$this->request->post['article_id'],
                'content'=>$this->request->post['content'],
                'arthor'=>'zkimyes',
                'custom_id'=>'1233'
            ]);
            $this->response->jsonOutput($this->request->post);
        }
    }
}