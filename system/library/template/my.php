<?php
namespace Template;
require_once DIR_VENDOR . '/autoload.php';
final class My {
    private $data = array();
    private $twig;

    public function __construct(){
        $loader = new \Twig_Loader_String();
        $this->twig = new \Twig_Environment($loader,[
            'cache'=>false
        ]);
    }
    
    public function set($key, $value) {
        $this->data[$key] = $value;
    }
    
    public function render($template) {
		$file = DIR_TEMPLATE.$template;
        if (file_exists($file)) {
            extract($this->data);

			ob_start();

			require($file);

			$output = ob_get_contents();

			ob_end_clean();
            return $this->twig->render($output,$this->data);
        } else {
            trigger_error('Error: Could not load template ' . $file . '!');
            exit();
        }
    }
}