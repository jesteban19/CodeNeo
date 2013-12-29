<?php

ini_set('display_errors',1);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'app' . DS);


try{

	require_once APP_PATH.'Config.php';
	require_once APP_PATH.'Autoload.php';
	Session::init();

	$registry=Registry::getInstancia();
	$registry->_request=new Request();
	$registry->_db=new Database();
	Bootstrap::run($registry->_request);
	
}
Catch(Exception $e){
	echo $e->GetMessage();
}


?>