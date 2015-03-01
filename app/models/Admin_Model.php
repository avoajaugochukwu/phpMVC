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