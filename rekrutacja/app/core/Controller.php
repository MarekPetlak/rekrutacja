<?php

class Controller {
   
   protected $smarty;
   
   
   public function __construct() {
      $this->smarty = new Smarty();
      $this->smarty->setTemplateDir('../app/views/templates');
      $this->smarty->setCompileDir('../app/templates_c');
      $this->smarty->setCacheDir('../app/cache');
      $this->smarty->setConfigDir('../app/configs');
      $this->smarty->assign('base_url', 'http://localhost/my_www/rekrutacja/');
   }
   
   protected function model($model) {
      require_once '../app/models/' . $model . '.php';
      return new $model();
   }

   protected function view($view, $data = []) {
      require_once '../app/views/' . $view . '.php';
   }
   
}
