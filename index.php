<?php
	/**
	*	@author Avoaja Ugochukwu
	* @version Biit to Framework version 1.0
	* @todo use autoloader to load classes
	*/

	define('DS',   DIRECTORY_SEPARATOR);
	define('ROOT', dirname(__FILE__) . DS);
	define('APP', ROOT . 'app' . DS);




	define('CORE', APP. 'core' . DS);
	define('CONTROLLER',  APP . 'controllers' . DS);
	define('ADMIN_DEPENDENCIES', CONTROLLER . DS . 'admin' . DS);
	define('EXT', '.php');





	require_once APP  . 'config/config' . EXT;
	require_once CORE . 'Bootstrap' . EXT;
	require_once CORE . 'Controller' . EXT;
	require_once CORE . 'Fetch' . EXT; // Database Logic
	require_once CORE . 'Model' . EXT;
	require_once CORE . 'View' . EXT;
	require_once CORE . 'Init' . EXT;

	define('ASSET', $baseUrl);
	// echo '<pre>';
	// echo ASSET . '<br>';
	// echo '</pre>';

	$app = new Bootstrap;
