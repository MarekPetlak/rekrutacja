<?php
error_reporting(E_ALL & ~E_NOTICE);

require_once 'core/ActiveRecord.php';
require_once 'configs/config.php';

$connections = array(
    'development' => 'mysql://' . $config['development']['db_user'] . ':' . $config['development']['db_password'] . '@' . $config['development']['db_adress'] . '/' . $config['development']['db_name'],
    'production' => 'mysql://' . $config['development']['db_user'] . ':' . $config['development']['db_password'] . '@' . $config['development']['db_adress'] . '/' . $config['development']['db_name'],
);


ActiveRecord\Config::initialize(function($cfg) use ($connections) {
   $cfg->set_model_directory('../app/models');
   $cfg->set_connections($connections);

   # default connection is now production
   $cfg->set_default_connection('production');
});

require_once 'smarty/Smarty.class.php';
require_once 'core/App.php';
require_once 'core/Controller.php';