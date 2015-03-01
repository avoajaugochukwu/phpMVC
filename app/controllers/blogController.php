<?php
class blogController extends Controller {
	public $model;
	function __construct() {
		// parent::__construct();


		// $this->model = $this->requireModel('Blog_Model');
		// $this->call_model('Blog_Model');
		$this->model = parent::call_model('Blog_Model');
		// $this->model = new Blog_Model;
		// print_r($this);
	}





	public function index($request = '')
	{
		if (!empty($request))
		{
			$this->blog($request);
		}
		else {
			$data['title'] = 'Blog Post';
			$data['heading'] = 'Blog Post';
			$data['post'] = parent::call_method($this->model, 'get_recent_posts');
			View::render('blog/home', $data);

		}


	}

	public function blog($request = '')
	{
		$request = [$request];
		$data['post'] = parent::call_method($this->model, 'get_specific_post', $request);
		$data['title'] = $data['post']['post_title'];
		$data['heading'] = $data['post']['post_title'];


		View::render('blog/detail', $data);


	}

}