<?php
	// require_once 'libs/Fetch.Category.php';
class postController extends adminController {
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
					$data['post_title'] = '';
					$data['post_keyword'] = '';
					$data['post_description'] = '';
					$data['title'] = 'Add new post';
					$data['heading'] = $data['title'];
					$data['post_content'] = '';
					$data['action'] = 'add';
					$data['post_category'] = '';
					$data['post_id'] = '';
					$data['authors'] = parent::call_method($this->model, 'get_author_for_add_form');
					$data['categories'] = parent::call_method($this->model, 'get_category_for_add_form');
					View::render('admin/post/post_form', $data);
					exit;
					break;

				case 'edit':
				// SELECT `postCategory` FROM `blog_posts` WHERE `postID` =1
					$params = [$id];
					$data['response'] = parent::call_method($this->model, 'am_getPostForEdit', $params);
					$data['title'] = 'Edit author';
					$data['heading'] = $data['title'];
					$data['post_id'] = $data['response']['postID'];
					$data['post_title'] = $data['response']['postTitle'];
					$data['post_category'] = $data['response']['postCategory'];
					$data['post_author'] = $data['response']['postAuthor'];
					$data['post_content'] = $data['response']['postCont'];
					$data['post_keyword'] = $data['response']['keyword'];
					$data['post_description'] = $data['response']['description'];
					$data['action'] = 'update';
					$data['categories'] = parent::call_method($this->model, 'get_category_for_add_form');
					View::render('admin/post/post_form', $data);
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
					$url = [$_POST['title']];
					$slug = parent::call_method($this->model, 'am_generate_url', $url);
					$post = [
										$_POST['title'],
										$_POST['editor1'],
										$slug,
										$_POST['author'],
										$_POST['category'],
										$_POST['keyword'],
										$_POST['description']
									];
					parent::call_method($this->model, 'am_add_post', $post);
					header('Location: ' . ASSET .'admin/post');
					exit;
					break;

				case 'update':
					$url = [$_POST['title']];
					$slug = parent::call_method($this->model, 'am_generate_url', $url);
					$post = [
										$_POST['title'],
										$slug,
										$_POST['editor1'],
										$_POST['post_id'],
										$_POST['category'],
										$_POST['keyword'],
										$_POST['description']
									];
					parent::call_method($this->model, 'am_updatePost', $post);
					header('Location: ' . ASSET .'admin/post');
					exit;
					break;

				case 'delete':
					$params = [$id];
					parent::call_method($this->model, 'am_deletePost', $params);
					header('Location: ' . ASSET .'admin/post');
					exit;
					break;

				default:
					echo 'Default';
					break;
			}
		}

	}
}
