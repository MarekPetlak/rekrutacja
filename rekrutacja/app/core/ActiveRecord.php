<?php

if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300)
   die('PHP ActiveRecord requires PHP 5.3 or higher');

define('PHP_ACTIVERECORD_VERSION_ID', '1.0');

require '../app/activerecord/Singleton.php';
require '../app/activerecord/Config.php';
require '../app/activerecord/Utils.php';
require '../app/activerecord/DateTime.php';
require '../app/activerecord/Model.php';
require '../app/activerecord/Table.php';
require '../app/activerecord/ConnectionManager.php';
require '../app/activerecord/Connection.php';
require '../app/activerecord/SQLBuilder.php';
require '../app/activerecord/Reflections.php';
require '../app/activerecord/Inflector.php';
require '../app/activerecord/CallBack.php';
require '../app/activerecord/Exceptions.php';

spl_autoload_register('activerecord_autoload');

function activerecord_autoload($class_name) {
   $path = ActiveRecord\Config::instance()->get_model_directory();
   $root = realpath(isset($path) ? $path : '.');

   if (($namespaces = ActiveRecord\get_namespaces($class_name))) {
      $class_name = array_pop($namespaces);
      $directories = array();

      foreach ($namespaces as $directory)
         $directories[] = $directory;

      $root .= DIRECTORY_SEPARATOR . implode($directories, DIRECTORY_SEPARATOR);
   }

   $file = "$root/$class_name.php";

   if (file_exists($file))
      require $file;
}

?>
