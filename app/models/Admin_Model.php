<?php
	// include 'Login_Model.php';
	// Structure Model -> Login_Model -> Admin_Model

	class Admin_Model extends Model {

		function __construct() {
			// parent::__construct();
			$this->connect = $this->getDb();
			// print_r($this->db);

			session_start();

		}

	/*Category*/
	public function get_all_category()
	{
		$result = $this->connect->select('blog_categories', 1, 'ASC', 10);
		
		foreach ($result as $row) {
			$categories[] = array(
												'category'   => $row['category'], 
												'categoryID' => $row['categoryID']
											);		
		}
		return $categories;
	}

	public function am_addCategory($category)
	{
		$result = $this->connect->addCategory($category);
	}

	public function am_getCategoryForEdit($id)
	{
		$result = $this->connect->fetchWhereSingle('blog_categories', 'categoryID', $id);

		$response = [];

		foreach ($result as $row) {
			$response['categoryID'] = $row['categoryID'];
			$response['category']		= $row['category'];
		}

		return $response;
	}

	public function am_updateCategory($category, $categoryID)
	{
		$result = $this->connect->updateCategory($category, $categoryID);
	}


	public function am_deleteCategory($category)
	{
		$result = $this->connect->deleteCategory($category);
	}

	/*-=---------------------------------------------------------*/





public function get_all_author()
	{
		$result = $this->connect->select('blog_members', 1, 'ASC', 10);

		foreach ($result as $row) {
			$authors[] = array(
												'memberID' => $row['memberID'],
												'username'   => $row['username'], 
												'email' => $row['email']
											);		
		}
		return $authors;
	}


public function am_addAuthor($username, $email, $password)
	{
		$result = $this->connect->authorAdd($username, $email, $password);
	}


	public function am_getAuthorForEdit($id)
	{
		$result = $this->connect->fetchWhereSingle('blog_members', 'memberID', $id);

		$response = [];

		foreach ($result as $row) {
			$response['memberID'] = $row['memberID'];
			$response['username']		= $row['username'];
			$response['email']   = $row['email'];
			$response['password'] = $row['password'];
		}

		return $response;
	}


	public function am_updateAuthor($id, $username, $email, $password)
	{
		$result = $this->connect->authorUpdate($id, $username, $email, $password);
	}


	public function am_deleteAuthor($id)
	{
		$result = $this->connect->authorDelete($id);
	}

///////////////////////////////////////////////////////////////////////////////////////////////////

	///////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////
	public function get_all_post()
	{
		// $result = $this->connect->paginate(3);
		$result = $this->connect->select('blog_posts', 1, 'ASC', 100);

		foreach ($result as $row) {
				$posts[] = array('post_title'    => $row['postTitle'],
												 'post_author'   => $row['postAuthor'],
												 'post_content'  => $row['postCont'],
												 'post_url'	 		 => $row['postUrl'],
												 'post_date'     => $row['postDate'],
												 'post_update'   => $row['postUpdate'],
												 'post_category' => $row['postCategory'],
												 'post_id'			 => $row['postID']
									);
		}
		return $posts;
	}

	public function get_author_for_add_form()
	{
		/* get Author */
		$result = $this->connect->select('blog_members', 1, 'DESC', 100);
		foreach ($result as $row) {
			$authors[] = array('author_id' => $row['memberID'], 'name' => $row['username']);
		}

		return $authors;
	}

	public function get_category_for_add_form()
	{
		/* get Categories */
		$result = $this->connect->select('blog_categories', 1, 'DESC', 100);
		foreach ($result as $row) {
			$categories[] = array('category_id' => $row['categoryID'], 'category' => $row['category']);
		}

		return $categories;
	}

	public function am_generate_url($url)
	{
		return $this->connect->generateUrl($url);
	}

	public function am_add_post($title, $editor1, $url, $authorID, $categoryID, $keyword, $description)
	{
		$result = $this->connect->fetchWhereSingle('blog_categories', 'categoryID', $categoryID);
		foreach ($result as $row) {
			$category 	= $row['category'];
			$categoryID = $row['categoryID'];
		}

		$result = $this->connect->fetchWhereSingle('blog_members', 'memberID', $authorID);
		foreach ($result as $row) {
			$author 		= $row['username'];
			$authorID		= $row['memberID'];
		}


		$this->connect->postInsert($title, $category, $editor1, $url, $author, $authorID, $categoryID, $keyword, $description);

	}

	public function am_getPostForEdit($id)
	{
		$result = $this->connect->fetchWhereSingle('blog_posts', 'postID', $id);

		$response = [];

		foreach ($result as $row) {
			foreach ($result as $row) {
				$response['postID'] = $row['postID'];
				$response['postTitle'] = $row['postTitle'];
				$response['postCategory'] = $row['postCategory'];
				$response['postCont'] = $row['postCont'];
				$response['postAuthor'] = $row['postAuthor'];
				$response['keyword'] = $row['keyword'];
				$response['description'] = $row['description'];
			}
		}

		return $response;
	}

public function am_updatePost($title, $url, $editor1, $post_id, $categoryID, $keyword, $description)
{
	$result = $this->connect->fetchWhereSingle('blog_categories', 'categoryID', $categoryID);
	foreach ($result as $row) {
		$category 	= $row['category'];
		$categoryID = $row['categoryID'];
	}
	echo '<h1>' . $post_id . '</h1>';
	$this->connect->postUpdate($title, $category, $url, $editor1, $post_id, $categoryID, $keyword, $description);
}

	public function am_deletePost($id)
	{
		$result = $this->connect->postDelete($id);
	}

















	public function attempt_login($name, $password)
	{
		if ($name == 'a' && $password == 'b')
		{
			echo 'Login success ful';
			$_SESSION['log'] = TRUE;
			return TRUE;
		}
		else {
			// unset($_SESSION['log']);
			return FALSE;
		}
		// print_r('<br><h1>' . $name . ' ' . $password . '</h1>');
		// echo 'I got here -> attempt_login';

		//logout timer logic
		// $inactive = 100;

		// $session_life = time() - $_session['timeout']; 
		// if($session_life > $inactive)
		// {
		// 	session_destroy(); header("Location: logoutpage.php");
		// }

		// $_session['timeout']=time();


	}


	public function is_session_set($session)
	{
		if (isset($_SESSION[$session]))
		{
			// print_r($_SESSION);
			// echo 'Session is set';
			return TRUE;
		}
		else {
			print_r($_SESSION);
			// echo 'Session is not set';
			return FALSE;
		}
	}
}