<?php
	class errorController  extends Controller {

		function __construct() {
			parent::__construct();
//      echo 'In side error File not found<br>';

			$data['title'] = 'Error Page';

		}

		function db_error($error)
		{
			$data['msg'] = $error;
			View::render('error/index', $data);
		}

		function file_not_found_error()
		{
			$data['msg'] = 'This page does not exist ';
			View::render('error/index', $data);
		}

}