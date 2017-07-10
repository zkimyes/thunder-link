<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/12
 * Time: 22:23
 */


class ControllerConfigSelf extends Controller{

    public function index(){
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => $this->url->link('common/home')
        );
        $data['breadcrumbs'][] = array(
            'text' => 'Config Your OSN',
            'href' => $this->url->link('solution/solution/index')
        );
        $data['breadcrumbs'][] = array(
            'text' => 'Self-help',
            'href' => $this->url->link('solution/solution/index')
        );
        $solutions = $this->db->query("SELECT * FROM oc_solution ORDER BY `order` DESC LIMIT 10 ");
        $data['solutions'] = array();
        $this->load->model('tool/image');
        if(!empty($solutions->rows)){
            foreach($solutions->rows as $k=>$solution){
                $data['solutions'][$k]['solution_title'] =$solution['solution_title'];
                $data['solutions'][$k]['description'] = html_entity_decode($solution['description'], ENT_QUOTES, 'UTF-8') . "\n";
                if ($solution['image']) {
                    $data['solutions'][$k]['image'] = $this->model_tool_image->resize($solution['image'], 400, 300);
                } else {
                    $data['solutions'][$k]['image'] = $this->model_tool_image->resize('placeholder.png', 400, 300);
                }
                $data['solutions'][$k]['href'] = $this->url->link('solution/solution/detail', 'solution_id=' . $solution['solution_id']);
            }
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/config/self.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/config/self.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/config/self.tpl', $data));
        }
    }

}