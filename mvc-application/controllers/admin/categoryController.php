<?php
	// require_once 'libs/Fetch.Category.php';
class categoryController extends adminController {
	public function __construct()
	{
		$this->model = Controller::call_model('Admin_Model');
	}




	public function urlchecker($method_verb = NULL, $id = NULL)
	{
		if ($_SERVER['REQUEST_METHOD'] === 'GET') 
		{
			// echo $method_verb . '  ' . $id . ' URLCHECK GET';
			switch ($method_verb)
			{
				case 'create':
					$data['category'] = '';
					$data['title'] = 'Add new category';
					$data['heading'] = $data['title'];
					$data['action'] = 'add';
					View::render('admin/category/category_form', $data);
					exit;
					break;

				case 'edit':
					$params = [$id];
					$data['response'] = parent::call_method($this->model, 'am_getCategoryForEdit', $params);
					$data['title'] = 'Edit category';
					$data['heading'] = $data['title'];
					$data['categoryID'] = $data['response']['categoryID'];
					$data['category'] = $data['response']['category'];
					$data['action'] = 'update';
					View::render('admin/category/category_form', $data);
					exit;
					break;

				default:
					echo 'Default';
					break;
			}
		}


		elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			// echo $method_verb . '  ' . $id . ' URLCHECK POST';

			switch ($method_verb)
			{
				case 'add':
					$category = [$_POST['category']];
					parent::call_method($this->model, 'am_addCategory', $category);
					header('Location: ' . ASSET .'admin/category');
					exit;
					break;

				case 'update':
					$params = [$_POST['category'], $_POST['categoryID']];
					parent::call_method($this->model, 'am_updateCategory', $params);
					header('Location: ' . ASSET .'admin/category');
					exit;
					break;

				case 'delete':
					$params = [$id];
					parent::call_method($this->model, 'am_deleteCategory', $params);
					header('Location: ' . ASSET .'admin/category');
					exit;
					break;

				default:
					echo 'Default';
					break;
			}
		}

	}
}
