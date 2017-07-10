<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/12
 * Time: 22:23
 */


class ControllerSolutionSolution extends Controller{

    public function index(){
        $data['breadcrumbs'][] = array(
            'text' => "Home",
            'href' => $this->url->link('common/home')
        );
        $data['breadcrumbs'][] = array(
            'text' => 'Solution',
            'href' => $this->url->link('solution/solution/index')
        );
        $solutions = $this->db->query("SELECT * FROM oc_solution_category ORDER BY `order` DESC LIMIT 10 ");
        $data['solutions'] = array();
        $this->load->model('tool/image');
        if(!empty($solutions->rows)){
            foreach($solutions->rows as $k=>$solution){
                $data['solutions'][$k]['title'] =$solution['title'];
                $data['solutions'][$k]['description'] = html_entity_decode($solution['description'], ENT_QUOTES, 'UTF-8') . "\n";
                if ($solution['image']) {
                    $data['solutions'][$k]['image'] = $this->model_tool_image->resize($solution['image'], 400, 300);
                } else {
                    $data['solutions'][$k]['image'] = $this->model_tool_image->resize('placeholder.png', 400, 300);
                }
                $data['solutions'][$k]['href'] = $this->url->link('solution/solution/category', 'category_id=' . $solution['category_id']);
            }
        }

        $this->document->setTitle("Huawei Optical Network Products Application Solutions - Thunder-link.com");
        $this->document->setDescription("Huawei Network Products solution for all Industries, Thunder-link.com");
        $this->document->setKeywords("Huawei Transmission solution, Huawei Access network solution, Huawei Datacommunication solution");
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/solution/index.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/solution/index.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/product/category.tpl', $data));
        }
    }


    public function category(){
        $solution_id = $this->request->get['category_id'];
        $data['solution_id'] = $solution_id;
        $this->load->model('tool/image');
        $data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => $this->url->link('common/home')
        );
        $data['breadcrumbs'][] = array(
            'text' => 'Solution',
            'href' => $this->url->link('solution/solution/index')
        );
        if(!empty($solution_id)){
            $solution = $this->db->query("SELECT * FROM oc_solution_category WHERE category_id=".$solution_id);
            $this->document->setTitle($solution->row['meta_title']);
            $this->document->setDescription($solution->row['meta_description']);
            $this->document->setKeywords($solution->row['meta_keyword']);
            if(!empty($solution->row)){
                $data['solution'] = $solution->row;
                if ($data['solution']['image']) {
                    $data['solution']['image'] = $this->model_tool_image->resize($data['solution']['image'], 400, 300);
                } else {
                    $data['solution']['image'] = $this->model_tool_image->resize('placeholder.png', 400, 300);
                }

                $data['related_product'] = array();
                if(!empty($data['solution']['category_id'])){
                    $r = $data['solution']["category_id"];
                    $related_product = $this->db->query("select * from oc_solution WHERE find_in_set('".$r."',category_id)");
                    if(!empty($related_product->rows)){
                        foreach($related_product->rows as $k=>$v){
                            if(!empty($v['image']) && file_exists(DIR_IMAGE.$v['image'])){
                                $v['image'] = $this->model_tool_image->resize($v['image'], 120, 120);
                            }else{
                                $v['image'] = $this->model_tool_image->resize('placeholder.png', 120, 120);
                            }
                            $v['description'] = utf8_substr(strip_tags(html_entity_decode($v['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..';
                            $v['href'] = $this->url->link('solution/solution/detail', 'solution_id=' . $v['solution_id']);
                            $data['related_product'][$k] = $v;
                        }
                    }
                    if(!empty($data['solution']['related_product_id'])){
                        $relate_solution = $this->db->query("SELECT * from oc_solution  WHERE solution_id IN (".$data['solution']['related_product_id'].")");
                        foreach($relate_solution->rows as &$v){
                            $v['description'] = utf8_substr(strip_tags(html_entity_decode($v['description'], ENT_QUOTES, 'UTF-8')), 0, 500) . '..';
                            $v['href'] = $this->url->link('solution/solution/detail', 'solution_id=' . $v['solution_id']);
                            $data['related_product'][$k] = $v;
                        }
                        $data['relate_solution'] = $relate_solution->rows;
                    }

                }
                $data['breadcrumbs'][] = array(
                    'text' => $solution->row['title'],
                    'href' => 'javascript:;'
                );
            }

            $data['content_top'] = $this->load->controller('common/content_top');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/solution/category.tpl', $data));
        }else{
            $url = '';
            $data['breadcrumbs'][] = array(
                'text' => "Home",
                'href' => $this->url->link('common/home', $url)
            );

            $data['breadcrumbs'][] = array(
                'text' => "Solution",
                'href' => $this->url->link('solution/solution', $url)
            );

            $this->document->setTitle("SOLUTION NOT FOUND");

            $data['heading_title'] = "SOLUTION NOT FOUND";

            $data['text_error'] = "SOLUTION NOT FOUND";

            $data['button_continue'] = "GO BACK";

            $data['continue'] = $this->url->link('solution/solution');

            $this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_top'] = $this->load->controller('common/content_top');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
            }
        }

    }

    public function detail(){
        $solution_id = $this->request->get['solution_id'];
        $this->load->model('tool/image');
        $data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => $this->url->link('common/home')
        );
        $data['breadcrumbs'][] = array(
            'text' => 'Solution',
            'href' => $this->url->link('solution/solution/index')
        );
        if(!empty($solution_id)){
            $solution = $this->db->query("SELECT * FROM oc_solution WHERE solution_id=".$solution_id);
            $data['solution'] = $solution->row;
            $this->document->setTitle($data['solution']['meta_title']);
            $this->document->setDescription($data['solution']['meta_description']);
            $this->document->setKeywords($data['solution']['meta_keyword']);
            if ($data['solution']['image']) {
                $data['solution']['image'] = $this->model_tool_image->resize($data['solution']['image'], 400, 300);
            } else {
                $data['solution']['image'] = $this->model_tool_image->resize('placeholder.png', 400, 300);
            }

            $category = $this->db->query("select title from oc_solution_category where category_id=".(int)$solution->row['category_id']);
            $data['breadcrumbs'][] = array(
                'text' => $category->row['title'],
                'href' => $this->url->link('solution/solution/category','category_id='.(int)$solution->row['category_id'])
            );
             $data['relate_solution'] = array();
             if(!empty($data['solution']['category_id'])){
                 $r = $data['solution']["category_id"];
                 $related_product = $this->db->query("select * from oc_solution WHERE find_in_set('".$r."',category_id)");
                 if(!empty($related_product->rows)){
                     foreach($related_product->rows as $k=>$v){
                         if(!empty($v['image']) && file_exists(DIR_IMAGE.$v['image'])){
                             $v['image'] = $this->model_tool_image->resize($v['image'], 120, 120);
                         }else{
                             $v['image'] = $this->model_tool_image->resize('placeholder.png', 120, 120);
                         }
                         $v['description'] = utf8_substr(strip_tags(html_entity_decode($v['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..';
                         $v['href'] = $this->url->link('solution/solution/detail', 'solution_id=' . $v['solution_id']);
                         $data['relate_solution'][$k] = $v;
                     }
                 }
             }

            $data['breadcrumbs'][] = array(
                'text' => $solution->row['solution_title'],
                'href' => 'javascript:;'
            );
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_top'] = $this->load->controller('common/content_top');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/solution/detail.tpl', $data));
        }else{
            $url = '';
            $data['breadcrumbs'][] = array(
                'text' => "Home",
                'href' => $this->url->link('common/home', $url)
            );

            $data['breadcrumbs'][] = array(
                'text' => "Solution",
                'href' => $this->url->link('solution/solution', $url)
            );

            $this->document->setTitle("SOLUTION NOT FOUND");

            $data['heading_title'] = "SOLUTION NOT FOUND";

            $data['text_error'] = "SOLUTION NOT FOUND";

            $data['button_continue'] = "GO BACK";

            $data['continue'] = $this->url->link('solution/solution');

            $this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_top'] = $this->load->controller('common/content_top');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
            }
        }
    }
}