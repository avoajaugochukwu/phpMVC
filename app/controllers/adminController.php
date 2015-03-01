<?php
/* since this is an MVC post data are readily available to the methods that correspond to the URL */
class adminController extends Controller {

	function __construct() {
		// parent::__construct();
		// $this->model = $this->call_model('Admin_Model');
		$this->model = parent::call_model('Admin_Model');

	}


	public function index(){


		$data['msg'] = 'This is the Admin page';
		$data['title'] = 'MVC - Admin Page';
		$data['heading'] = $data['title'];

		// require 'models/Admin_Model.php';
		// $model = new Admin_Model();


		View::render('admin/index', $data);
	}


	public function author($method_verb = NULL, $id = NULL)
	{
		echo $method_verb . '  ' . $id;
		if($this->check_for_login_logout())
		{
			// echo '<h1>'. 'Ctegory is ready'.'</h1>';
			if (isset($method_verb))
			{
				// require_once 'admin/categoryController.php';
				$authorController = 'authorController';
				$this->authorController = new $authorController;


				$this->authorController->urlchecker($method_verb, $id);
			}


			$data['author'] = parent::call_method($this->model, 'get_all_author');
			$data['title'] = 'Author List';
			$data['heading'] = $data['title'];
			View::render('admin/author/index', $data);
		}


	}








	public function category($method_verb = NULL, $id = NULL)
	{
		// unset($_SESSION);
		// session_destroy();
		echo $method_verb . '  ' . $id;
		if($this->check_for_login_logout())
		{
			// echo '<h1>'. 'Ctegory is ready'.'</h1>';
			if (isset($method_verb))
			{
				// require_once 'admin/categoryController.php';
				$categoryController = 'categoryController';
				$this->categoryController = new $categoryController;


				$this->categoryController->urlchecker($method_verb, $id);
			}


			$data['category'] = parent::call_method($this->model, 'get_all_category');
			$data['title'] = 'Category List';
			$data['heading'] = $data['title'];
			View::render('admin/category/index', $data);
		}


	}









	public function post()
	{
		echo 'I am the post';
	}

	public function check_for_login_logout()
	{
		/* check if logout was clicked so as to avoid other tests */
		if (isset($_POST['action']) && $_POST['action'] == 'Logout')
		{
			// echo 'You clicked logout';
			unset($_SESSION['log']);
			session_destroy();
			header('Location: ' . '..');
			return;
		}



		if (isset($_POST['name']) && isset($_POST['password']))
		{
			$post_info = array($_POST['name'], $_POST['password']);
			if(parent::call_method($this->model, 'attempt_login', $post_info))
			{
				// echo '<h1>Here Else</h1>';
				// $this->view->render('admin/success_login');
				return TRUE;
			}
		}

		elseif (isset($_SESSION['log']))
		{
			$log = ['log'];
			parent::call_method($this->model, 'is_session_set', $log);
			// echo '<h1>Session is alive</h1>';
			return TRUE;
			// $this->view->render('admin/success_login');
		}

		else {
			echo ' I was Redirected here';
			$data['title'] = 'Login Page';
			$data['heading'] = $data['title'];
			View::render('admin/login', $data);
			return FALSE;
		}



		// print_r($_SESSION);
		// session_destroy();
		// print_r($_POST['name']);
		// print_r($_POST['password']);
	}




}