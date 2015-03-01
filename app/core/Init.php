<?php

	/**
	*	This file is use less it just produces the url at the top of every page to get rid in production
	 * @uses Get the ABSOLUTE base url for including ASSET files
	 */

	$baseUrl = $_SERVER['HTTP_HOST'] . $_SERVER["SCRIPT_NAME"];
	$baseUrl = explode('/', $baseUrl);
	$currentFilename = $baseUrl[count($baseUrl) - 1];
	$baseUrl = implode('/', $baseUrl);
	$baseUrl = str_replace($currentFilename, '', $baseUrl);
	$parsed = parse_url($baseUrl);
	(empty($parsed['scheme'])) ? $baseUrl = 'http://' . $baseUrl : $baseUrl;
	// echo '<pre>';
	// echo $baseUrl . '<br>';
	// echo 'http://localhost/laboratory/library/MVCs/netBeans_MVC/';
	// echo '</pre>';


//	define('ASSET_URL', $baseUrl);

?>