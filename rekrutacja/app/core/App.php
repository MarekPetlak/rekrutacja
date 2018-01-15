<?php

class App {

   protected $controller = 'users';
   protected $method = 'index';
   protected $params = [];

   public function __construct() {
      $url = $this->ParseUrl();
      
      if (isset($url[0]) && file_exists('../app/controllers/' . $url[0] . '.php')) {
         $this->controller = $url[0];
      }


      require_once '../app/controllers/' . $this->controller . '.php';
      $this->controller = new $this->controller;

      if (isset($url[1]) && method_exists($this->controller, $url[1])) {
         $this->method = $url[1];
      }

      unset($url[0]);
      unset($url[1]);

      $this->params = $url ? array_values($url) : [];
      call_user_func_array([$this->controller, $this->method], $this->params);
   }

   public function ParseUrl() {
      if (isset($_GET['url'])) {
         return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
      }
   }

}
