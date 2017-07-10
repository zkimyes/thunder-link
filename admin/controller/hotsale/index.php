<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/19
 * Time: 15:24
 */


class ControllerHotSaleIndex extends Controller {

    public function index(){
        $data['heading_title'] = "Hot Sale";

        $data['text_form'] = "Edit Hot Sale";

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_filter_add'] = $this->language->get('button_filter_add');
        $data['button_remove'] = $this->language->get('button_remove');
        $url = "";
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['success'])) {
            $data['success'] = $this->error['success'];
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => "Hot Sale Cateogry",
            'href' => $this->url->link('hotsale/index', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );


        $data['token'] = $this->session->data['token'];

        $filter_data = array(
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $data['hotsale'] = array();

        $category_total = $this->db->query("select count(*) as count from oc_hotsale_category");
        $category_total = $category_total->row['count'];

        $results = $this->db->query("select * from oc_hotsale_category order by sort_order asc limit ".$filter_data['start'].",".$filter_data['limit']);

        foreach ($results->rows as $result) {
            $data['hotsale'][] = array(
                'id' => $result['id'],
                'name'        => $result['name'],
                'sort_order'  => $result['sort_order'],
                'home'=>$result['home']
            );
        }


        $pagination = new Pagination();
        $pagination->total = $category_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('hotsale/index', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
        $data['results'] = sprintf($this->language->get('text_pagination'), ($category_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($category_total - $this->config->get('config_limit_admin'))) ? $category_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $category_total, ceil($category_total / $this->config->get('config_limit_admin')));
        $data['pagination'] = $pagination->render();
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('hotsale/hotsale.tpl', $data));
    }


    /**
     * category add
     */
    public function cadd(){
        $data['name'] = $this->request->post['name'];
        $data['id'] = $this->request->post['id'];
        $data['sort_order'] = $this->request->post['sort_order'];
        $data['home'] = $this->request->post['home'];
        if(!empty($data['id'])){
            $rs = $this->db->query("update oc_hotsale_category set name='".$this->db->escape($data['name'])."',sort_order='".(int)$data['sort_order']."',home=".(int)$data['home']." where id=".(int)$data['id']);
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($rs));
        }else{
            $rs = $this->db->query("insert into oc_hotsale_category set name='".$this->db->escape($data['name'])."',sort_order='".(int)$data['sort_order']."',create_time=NOW()");
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($rs));
        }
    }


    public function cdelt(){
        $data['cid'] = $this->request->get['cid'];
        if(!empty($data['cid'])){
            $rs = $this->db->query("delete from oc_hotsale_category WHERE id=".(int)$data['cid']);
            $this->db->query("delete from oc_hotsale_products WHERE hotsale_category=".(int)$data['cid']);
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($rs));
        }
    }



    public function products(){
        $data['heading_title'] = "Hot Sale";
        $data['text_form'] = "Edit Hot Sale Products";
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_filter_add'] = $this->language->get('button_filter_add');
        $data['button_remove'] = $this->language->get('button_remove');
        $url = "";
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['success'])) {
            $data['success'] = $this->error['success'];
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => "Hot Sale products",
            'href' => $this->url->link('hotsale/index/products', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );


        $data['token'] = $this->session->data['token'];

        $filter_data = array(
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $data['hotsale'] = array();

        $category_total = $this->db->query("select count(*) as count from oc_hotsale_products");
        $category_total = $category_total->row['count'];

        $results = $this->db->query("select * from oc_hotsale_products order by sort_order asc limit ".$filter_data['start'].",".$filter_data['limit']);
        foreach ($results->rows as $result) {
            $productname = $this->db->query("select name from oc_product_description WHERE product_id=".(int)$result['product_id']);
            $data['hotsale'][] = array(
                'product_id' => $result['product_id'],
                'name'=>$productname->row['name'],
                'hotsale_category'=>$result['hotsale_category'],
                'description'  => $result['description'],
                'sort_order'  => $result['sort_order'],
                'home'=>$result['home']
            );
        }


        $pagination = new Pagination();
        $pagination->total = $category_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('hotsale/index', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
        $data['results'] = sprintf($this->language->get('text_pagination'), ($category_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($category_total - $this->config->get('config_limit_admin'))) ? $category_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $category_total, ceil($category_total / $this->config->get('config_limit_admin')));
        $data['pagination'] = $pagination->render();

        $data['categorys'] = $this->db->query("select * from oc_hotsale_category ORDER BY sort_order asc");
        $data['categorys'] = $data['categorys']->rows;

        $data['products'] = $this->db->query("select a.product_id,b.name from oc_product a LEFT JOIN oc_product_description b ON a.product_id = b.product_id WHERE status=1");
        $data['products'] = $data['products']->rows;
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('hotsale/products.tpl', $data));
    }



    public function padd(){
        $this->db->query("delete from oc_hotsale_products WHERE product_id=".(int)$this->request->post['product_id']);
        $rs = $this->db->query("insert into oc_hotsale_products set product_id=".(int)$this->request->post['product_id'].", hotsale_category=".(int)$this->request->post['hotsale_category'].", description='".$this->db->escape($this->request->post['description'])."', sort_order=".(int)$this->request->post['sort_order'].",home=".(int)$this->request->post['home']);
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($rs));
    }



    public function pdelt(){
        $data['product_id'] = $this->request->get['product_id'];
        if(!empty($data['product_id'])){
            $rs = $this->db->query("delete from oc_hotsale_products WHERE product_id=".(int)$data['product_id']);
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($rs));
        }
    }


}