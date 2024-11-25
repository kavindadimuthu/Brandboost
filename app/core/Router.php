<?php
// This Router class will parse the URL and call the appropriate controller and method
// The URL will be in the format of /controller/method/params
// For example, /user/show/1 will call the show method of the UserController with parameter 1

class Router {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();
        // print_r($url);  // This will print the URL array

        if (isset($url[1]) && file_exists(__DIR__ . '/../controllers/' . $url[1] . '.php')) {
            $this->controller = $url[1] ;
            unset($url[1]);
            // print_r($url[0]);
        }

        require_once __DIR__ . "/../controllers/{$this->controller}.php";
        $this->controller = new $this->controller;

        if (isset($url[2]) && method_exists($this->controller, $url[2])) {
            $this->method = $url[2];
            unset($url[2]);
        }

        $this->params = $url ? array_values($url) : [];

        if (!empty($this->params)) {
            array_shift($this->params);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_SERVER['REQUEST_URI'])) {
            return explode('/', filter_var(rtrim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));
        }
    }
}

