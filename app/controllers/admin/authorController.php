<?php
	// require_once 'libs/Fetch.Category.php';
class authorController extends adminController {
	public function __construct()
	{
		$this->model = Controller::call_model('Admin_Model');
	}




	public function urlchecker($method_verb = NULL, $id = NULL)
	{
		if ($_SERVER['REQUEST_METHOD'] === 'GET') 
		{
			echo $method_verb . '  ' . $id . ' URLCHECK GET';
			switch ($method_verb)
			{
				case 'create':
					$data['username'] = '';
					$data['email'] = '';
					$data['password'] = '';
					$data['title'] = 'Add new Author';
					$data['heading'] = $data['title'];
					$data['action'] = 'add';
					View::render('admin/author/author_form', $data);
					exit;
					break;

				case 'edit':
					$params = [$id];
					$data['response'] = parent::call_method($this->model, 'am_getAuthorForEdit', $params);
					$data['title'] = 'Edit author';
					$data['heading'] = $data['title'];
					$data['memberID'] = $data['response']['memberID'];
					$data['username'] = $data['response']['username'];
					$data['email'] = $data['response']['email'];
					$data['password'] = $data['response']['password'];
					$data['action'] = 'update';
					View::render('admin/author/author_form', $data);
					exit;
					break;

				default:
					echo 'Default';
					break;
			}
		}


		elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			echo $method_verb . '  ' . $id . ' URLCHECK POST';

			switch ($method_verb)
			{
				case 'add':
					$author = [$_POST['username'], $_POST['email'], $_POST['password']];
					parent::call_method($this->model, 'am_addAuthor', $author);
					header('Location: ' . ASSET .'admin/author');
					exit;
					break;

				case 'update':
					$author = [$_POST['memberID'], $_POST['username'], $_POST['email'], $_POST['password']];
					print_r($author);
					parent::call_method($this->model, 'am_updateAuthor', $author);
					header('Location: ' . ASSET .'admin/author');
					exit;
					break;

				case 'delete':
					$params = [$id];
					parent::call_method($this->model, 'am_deleteAuthor', $params);
					header('Location: ' . ASSET .'admin/author');
					exit;
					break;

				default:
					echo 'Default';
					break;
			}
		}

	}
}
