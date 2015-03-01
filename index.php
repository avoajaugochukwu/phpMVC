<?php

// use an autoloader
	define('DS',   DIRECTORY_SEPARATOR);
	define('ROOT', dirname(__FILE__) . DS);
	define('APP', ROOT . 'app' . DS);
	
	define('CORE', APP. 'core' . DS);
	define('CONTROLLER',  APP . 'controllers' . DS);
	define('ADMIN_DEPENDENCIES', CONTROLLER . DS . 'admin' . DS);
	define('EXT', '.php');

// define('ASSET', 'http://localhost/laboratory/library/MVCs/netBeans_MVC/');
// 	define('ASSET', $baseUrl);



// define(URL, 'http://' . $_SERVER['HTTP_HOST'] . '/laboratory/library/MVC\'s/netBeans_MVC/');

 /**
 * echo realpath(dirname(__DIR__)) . '<br>';
 * echo realpath(dirname(__FILE__)) . '<br>';
 * define(USE FOR LIVE DEPLOYMENT, 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
 * echo USE FOR LIVE DEPLOYMENT;
*/

	// require_once CORE . 'Bootstrap' . EXT;
	require_once APP  . 'config/config' . EXT;
	require_once CORE . 'BootstrapTest' . EXT;
	require_once CORE . 'Controller' . EXT;
	require_once CORE . 'Fetch' . EXT; // Database Logic
	require_once CORE . 'Model' . EXT;
	require_once CORE . 'View' . EXT;
	require_once CORE . 'Init' . EXT;

	define('ASSET', $baseUrl);
	echo '<pre>';
	echo ASSET . '<br>';
	echo '</pre>';

	$app = new Bootstrap;
