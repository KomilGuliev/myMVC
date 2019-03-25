<?php 

namespace application\core;

class View {

    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route) {
        $this->route = $route;
        $this->path = $this->route['controller'].'/'.$this->route['action'];

    }

    public function render($title, $vars = []) {
        $path = 'application/views/'.$this->path.'.php';
        extract($vars);
        if(file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'application/views/layout/'.$this->layout.'.php';
        } else {
            echo 'Не найден вид : '.$path;
        }
    }

    public function redirect($url) {
        header('location: '.$url);
        exit;
    }

    public static function errorCode($code) {
        http_response_code($code);
        require 'application/views/errors/'.$code.'.php';
        exit;
    }

    public function message($status, $message) {
        exit(json_encode(['status' => 'success', 'message' => 123 ]));
    }

    public function location($url) {
        exit(json_encode(['url' => $url]));        
    }

}