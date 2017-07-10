<?php
class ControllerCommonSeoUrl extends Controller {

	public function index() {

		// Add rewrite to url class
		if ($this->config->get('config_seo_url')) {
			$this->url->addRewrite($this);
		}

		// Decode URL
		if (isset($this->request->get['_route_'])) {
			$parts = explode('/', $this->request->get['_route_']);
			// remove any empty arrays from trailing
			if (utf8_strlen(end($parts)) == 0) {
				array_pop($parts);
			}
            foreach ($parts as $part) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($part) . "'");
                if ($query->num_rows) {
                    $url = explode('=', $query->row['query']);

                    if ($url[0] == 'product_id') {
                        $this->request->get['product_id'] = $url[1];
                    }

                    if ($url[0] == 'category_id') {
                        if (!isset($this->request->get['path'])) {
                            $this->request->get['path'] = $url[1];
                        } else {
                            $this->request->get['path'] .= '_' . $url[1];
                        }
                    }

                    if ($url[0] == 'manufacturer_id') {
                        $this->request->get['manufacturer_id'] = $url[1];
                    }

                    if ($url[0] == 'information_id') {
                        $category_id = $this->db->query("select categroy from oc_information WHERE information_id=".(int)$url[1]);
                        $category_type = $this->db->query("select type from oc_information_category WHERE category_id=".(int)$category_id->row['categroy']);
                        if($category_type->row['type'] == '1'){
                            $this->request->get['route'] = 'aboutus/index/index';
                        }else{
                            $this->request->get['route'] = 'support/index/detail';
                        }
                        $this->request->get['information_id'] = $url[1];
                    }

                    if ($query->row['query'] && $url[0] != 'information_id' && $url[0] != 'manufacturer_id' && $url[0] != 'category_id' && $url[0] != 'product_id') {
                        $this->request->get['route'] = $query->row['query'];
                    }

                    if($query->row['query'] && $url[0] == 'infor_category_id'){
                        $this->request->get['category_id'] = $url[1];
                        $this->request->get['route'] = 'support/index/category';
                    }

                    if($url[0]== 'solution_category_id' && $url[1]) {//solution category
                        $this->request->get['category_id'] = $url[1];
                        $this->request->get['route'] = 'solution/solution/category';
                    }


                    if($url[0] == 'cid' && $url[1]){
                        $this->request->get['product_id'] = $url[1];
                        $this->request->get['route'] = 'config/index';
                    }

                    if($parts[0] == "configure" && $url[0] == "category_id"){
                        $this->request->get['category_id'] = $url[1];
                        $this->request->get['route'] = 'config/index';
                    }


                    if($parts[0] == "solution" && empty($parts[1])){
                        $this->request->get['route']=="solution/solution/index";
                    }


                    if($parts[0] == 'company'){
                        $this->request->get['route']=="aboutus/index";
                    }


                    /**
                     * solutions details
                     */
                    if($parts[0] == "solution" && !empty($parts[1])){
                        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $this->db->escape($parts[1]) . "'");
                        if ($query->num_rows) {
                            $url = explode('=', $query->row['query']);
                            if($url[0] == "solution_category_id"){
                                $this->request->get['category_id'] = $url[1];
                                $this->request->get['route'] = 'solution/solution/category';
                            }else{
                                $this->request->get['solution_id'] = $url[1];
                                $this->request->get['route'] = 'solution/solution/detail';
                            }

                        }
                    }

                } else {
                    $this->request->get['route'] = 'error/not_found';

                    break;
                }
            }

			if (!isset($this->request->get['route'])) {
				if (isset($this->request->get['product_id'])) {
					$this->request->get['route'] = 'product/product';
				} elseif (isset($this->request->get['path'])) {
					$this->request->get['route'] = 'product/category';
				} elseif (isset($this->request->get['manufacturer_id'])) {
					$this->request->get['route'] = 'product/manufacturer/info';
				}
			}

			if (isset($this->request->get['route'])) {
				return new Action($this->request->get['route']);
			}
		}
	}

	public function rewrite($link) {
		$url_info = parse_url(str_replace('&amp;', '&', $link));
		$url = '';
		$data = array();
        if(isset($url_info['query']))
         parse_str($url_info['query'], $data);
		foreach ($data as $key => $value) {
			if (isset($data['route'])) {
				if (($data['route'] == 'product/product' && $key == 'product_id') || (($data['route'] == 'product/manufacturer/info' || $data['route'] == 'product/product') && $key == 'manufacturer_id') ) {
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");
					if ($query->num_rows && $query->row['keyword']) {
                        $url = '/' . $query->row['keyword'];
						unset($data[$key]);
					}
				} elseif ($key == 'path') {
					$categories = explode('_', $value);
					foreach ($categories as $category) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'category_id=" . (int)$category . "'");
						if ($query->num_rows && $query->row['keyword']) {
							$url = '/' . $query->row['keyword'];
						} else {
							$url = '';
							break;
						}
					}

					unset($data[$key]);
				}


                /**
                 * config
                 */
                if($data['route'] == "config/index" && $key=="category_id"){

                    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");
                    if ($query->num_rows && $query->row['keyword']) {
                        $url = '/configure/' . $query->row['keyword'];
                        unset($data[$key]);
                    } else {
                        $url = '';
                        break;
                    }
                }

                /**
                 * config products
                 */
                if($data['route'] == "config/index" && $key == "product_id"){
                    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape('cid=' . (int)$value) . "'");
                    if ($query->num_rows && $query->row['keyword']) {
                        $url = '/configure/' . $query->row['keyword'];
                        unset($data[$key]);
                    } else {
                        $url = '';
                        break;
                    }
                }


                if($data['route']=="common/home"){
                    $url = " ";
                }


                if($data['route'] =='common/documents'){
                    $url = "/documents";
                }


                if($data['route'] == 'common/hotsale'){
                    $url = '/hotsale';
                }

                if($data['route'] == 'account/login'){
                    $url = '/login';
                }

                if($data['route'] == 'account/register'){
                    $url = '/register';
                }

                if($data['route']=="product/index"){
                    $url = "/products";
                }


                if($data['route'] == 'product/search'){
                    $url = '/search';
                }

                if($data['route']=="config/index" && $key != "product_id" && $key !="category_id"){
                    $url = "/configure";
                }

                if($data['route']=="support/index" && $key != "category_id"){
                    $url = "/support";
                }


                if($data['route']=="aboutus/index" && $key !='information_id'){
                    $url = "/company";
                }

                if($data['route'] == "solution/solution/index"){
                    $url = "/solution";
                }

                /**
                 * solution category
                 */
                if($data['route'] == "solution/solution/category" && $key == "category_id"){
                    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape('solution_category_id=' . (int)$value) . "'");
                    if ($query->num_rows && $query->row['keyword']) {
                        $url = '/solution/' . $query->row['keyword'];
                        unset($data[$key]);
                    }
                }

                /**
                 * solution detail
                 */
               if($data['route'] == "solution/solution/detail" && $key == "solution_id"){
                   $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");
                   if ($query->num_rows && $query->row['keyword']) {
                       $url = '/solution/' . $query->row['keyword'];
                       unset($data[$key]);
                   }
                }


                if($data['route'] == "support/index/category" && !empty($value)){
                    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape( 'infor_category_id=' . (int)$value) . "'");
                    if ($query->num_rows && $query->row['keyword']) {
                        $url = '/support/' . $query->row['keyword'];
                        unset($data[$key]);
                    }
                }

                if($key=="information_id" && $data['route'] == "support/index/detail"){
                    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");
                    if ($query->num_rows && $query->row['keyword']) {
                        $url = '/support/' . $query->row['keyword'];
                        unset($data[$key]);
                    }
                }

                if($key=="information_id" && $data['route'] == "aboutus/index"){
                    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = '" . $this->db->escape($key . '=' . (int)$value) . "'");
                    if ($query->num_rows && $query->row['keyword']) {
                        $url = '/company/' . $query->row['keyword'];
                        unset($data[$key]);
                    }
                }
            }
		}
		if ($url) {
			unset($data['route']);

			$query = '';
			if ($data) {
				foreach ($data as $key => $value) {
					$query .= '&' . rawurlencode((string)$key) . '=' . rawurlencode((string)$value);
				}

				if ($query) {
					$query = '?' . str_replace('&', '&amp;', trim($query, '&'));
				}
			}
			return $url_info['scheme'] . '://' . $url_info['host'] . (isset($url_info['port']) ? ':' . $url_info['port'] : '') . str_replace('/index.php', '', $url_info['path']) . $url . $query;
		} else {
			return $link;
		}
	}
}
