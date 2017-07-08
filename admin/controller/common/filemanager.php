<?php

class ControllerCommonFileManager extends Controller {
    
    public function index() {
      $this->response->jsonOutput(['a'=>'1']);
    }
    
    public function upload() {
        $this->load->language('common/filemanager');
        
        $json = array();
        
        // Check user has permission
        if (!$this->user->hasPermission('modify', 'common/filemanager')) {
            $json['error'] = $this->language->get('error_permission');
        }
        
        // Make sure we have the correct directory
        if (isset($this->request->get['directory'])) {
            $directory = rtrim(DIR_IMAGE . 'catalog/' . str_replace(array('../', '..\\', '..'), '', $this->request->get['directory']), '/');
        } else {
            $directory = DIR_IMAGE . 'catalog';
        }
        
        // Check its a directory
        if (!is_dir($directory)) {
            $json['error'] = $this->language->get('error_directory');
        }
        
        if (!$json) {
            if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
                // Sanitize the filename
                $filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));
                
                // Validate the filename length
                if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 255)) {
                    $json['error'] = $this->language->get('error_filename');
                }
                
                // Allowed file extension types
                $allowed = array(
                'jpg',
                'jpeg',
                'gif',
                'png'
                );
                
                if (!in_array(utf8_strtolower(utf8_substr(strrchr($filename, '.'), 1)), $allowed)) {
                    $json['error'] = $this->language->get('error_filetype');
                }
                
                // Allowed file mime types
                $allowed = array(
                'image/jpeg',
                'image/pjpeg',
                'image/png',
                'image/x-png',
                'image/gif'
                );
                
                if (!in_array($this->request->files['file']['type'], $allowed)) {
                    $json['error'] = $this->language->get('error_filetype');
                }
                
                // Return any upload error
                if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
                    $json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
                }
            } else {
                $json['error'] = $this->language->get('error_upload');
            }
        }
        
        if (!$json) {
            move_uploaded_file($this->request->files['file']['tmp_name'], $directory . '/' . $filename);
            
            $json['success'] = $this->language->get('text_uploaded');
        }
        
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    
    public function folder() {
        $this->load->language('common/filemanager');
        
        $json = array();
        
        // Check user has permission
        if (!$this->user->hasPermission('modify', 'common/filemanager')) {
            $json['error'] = $this->language->get('error_permission');
        }
        
        // Make sure we have the correct directory
        if (isset($this->request->get['directory'])) {
            $directory = rtrim(DIR_IMAGE . 'catalog/' . str_replace(array('../', '..\\', '..'), '', $this->request->get['directory']), '/');
        } else {
            $directory = DIR_IMAGE . 'catalog';
        }
        
        // Check its a directory
        if (!is_dir($directory)) {
            $json['error'] = $this->language->get('error_directory');
        }
        
        if (!$json) {
            // Sanitize the folder name
            $folder = str_replace(array('../', '..\\', '..'), '', basename(html_entity_decode($this->request->post['folder'], ENT_QUOTES, 'UTF-8')));
            
            // Validate the filename length
            if ((utf8_strlen($folder) < 3) || (utf8_strlen($folder) > 128)) {
                $json['error'] = $this->language->get('error_folder');
            }
            
            // Check if directory already exists or not
            if (is_dir($directory . '/' . $folder)) {
                $json['error'] = $this->language->get('error_exists');
            }
        }
        
        if (!$json) {
            mkdir($directory . '/' . $folder, 0777);
            chmod($directory . '/' . $folder, 0777);
            
            $json['success'] = $this->language->get('text_directory');
        }
        
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
    
    public function delete() {
        $this->load->language('common/filemanager');
        
        $json = array();
        
        // Check user has permission
        if (!$this->user->hasPermission('modify', 'common/filemanager')) {
            $json['error'] = $this->language->get('error_permission');
        }
        
        if (isset($this->request->post['path'])) {
            $paths = $this->request->post['path'];
        } else {
            $paths = array();
        }
        
        // Loop through each path to run validations
        foreach ($paths as $path) {
            $path = rtrim(DIR_IMAGE . str_replace(array('../', '..\\', '..'), '', $path), '/');
            
            // Check path exsists
            if ($path == DIR_IMAGE . 'catalog') {
                $json['error'] = $this->language->get('error_delete');
                
                break;
        }
    }
    
    if (!$json) {
        // Loop through each path
        foreach ($paths as $path) {
            $path = rtrim(DIR_IMAGE . str_replace(array('../', '..\\', '..'), '', $path), '/');
            
            // If path is just a file delete it
            if (is_file($path)) {
                unlink($path);
                
                // If path is a directory beging deleting each file and sub folder
            } elseif (is_dir($path)) {
                $files = array();
                
                // Make path into an array
                $path = array($path . '*');
                
                // While the path array is still populated keep looping through
                while (count($path) != 0) {
                    $next = array_shift($path);
                    
                    foreach (glob($next) as $file) {
                        // If directory add to path array
                        if (is_dir($file)) {
                            $path[] = $file . '/*';
                            }
                            
                            // Add the file to the files to be deleted array
                            $files[] = $file;
                            }
                            }
                            
                            // Reverse sort the file array
                            rsort($files);
                            
                            foreach ($files as $file) {
                            // If file just delete
                            if (is_file($file)) {
                            unlink($file);
                            
                            // If directory use the remove directory function
                            } elseif (is_dir($file)) {
                            rmdir($file);
                            }
                            }
                            }
                            }
                            
                            $json['success'] = $this->language->get('text_delete');
                            }
                            
                            $this->response->addHeader('Content-Type: application/json');
                            $this->response->setOutput(json_encode($json));
                            }
                            }