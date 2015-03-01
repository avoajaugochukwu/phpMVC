<?php
	class errorController  extends Controller {

		function __construct() {
			parent::__construct();
//      echo 'In side error File not found<br>';

			$this->view->title = 'Error Page';

		}

		function db_error($error)
		{
			$this->view->msg = $error;
			$this->view->render('error/index');
		}

		function file_not_found_error()
		{
			$this->view->msg = 'This page does not exist ';
			$this->view->render('error/index');
		}

}