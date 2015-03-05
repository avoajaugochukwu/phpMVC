<?php
	/**
	* @author Avoaja Ugochukwu Charles
	* @abstract For select queries
	*/
	require_once 'Database.php';
	/* set default time zone */
	date_default_timezone_set('Africa/Lagos');


	class Fetch
	{
		public $pdo;

		public function __construct()
		{
			$db = new Database;
			$this->pdo = $db->db();
			return $this->pdo;
		}

		public function select($table, $order_by = 1, $asc = 'ASC', $limit = 100)
		{
				
			try {
				$sql = "SELECT * FROM {$table} ORDER BY {$order_by} {$asc} LIMIT {$limit}";
				$this->stmt = $this->pdo->prepare($sql);
				$this->stmt->execute();
			} catch (PDOException $e) {
				$error = $e->getMessage();
				include '../public/error.html';
				exit;
			}
		
			return $this->stmt->fetchAll();
		}



		public function fetchHomePage($table1, $table2, $order_by = 1, $asc = 'ASC', $limit = 100)
		{
			try {
				$sql = "SELECT * FROM {$table1}, {$table2} ORDER BY {$order_by} {$asc} LIMIT {$limit}";
				$this->stmt = $this->pdo->prepare($sql);
				$this->stmt->execute();
			} catch (PDOException $e) {
				$error = $e->getMessage();
				include '../public/error.html';
				exit;
			}		
			return $this->stmt->fetchAll();
		}


		public function recentPost($table, $order_by = 1, $asc = 'ASC', $limit1, $limit2)
		{
			try {
				$sql = "SELECT * FROM {$table} ORDER BY {$order_by} {$asc} LIMIT {$limit1}, {$limit2}";
				$this->stmt = $this->pdo->prepare($sql);
				$this->stmt->execute();
			} catch (PDOException $e) {
				$error = $e->getMessage();
				// include '../public/error.html';
				include 'public/views_template/error/index.php';
				exit;
			}		
			return $this->stmt->fetchAll();
		}


		public function fetchWhere($table1, $table2, $where_field, $where_value)
		{
			try {
				$sql = "SELECT * FROM {$table1} LEFT JOIN {$table2} ON blog_posts.postAuthor = blog_members.username WHERE $where_field = :toBindValue";
				// online version uses			$sql = "SELECT * FROM {$table1} LEFT JOIN {$table2} ON $where_field = :toBindValue";
				$this->stmt = $this->pdo->prepare($sql);
				$this->stmt->bindValue(':toBindValue', $where_value);
				$this->stmt->execute();
			} catch (PDOException $e) {
				$error = $e->getMessage();
				include '../public/error.html';
				exit;
			}

			return $this->stmt->fetchAll();
		}

		public function fetchWhereSingle($table1, $where_field, $where_value)
		{
			try {
				$sql = "SELECT * FROM {$table1} WHERE $where_field = :toBindValue";
			$this->stmt = $this->pdo->prepare($sql);
			$this->stmt->bindValue(':toBindValue', $where_value);
			$this->stmt->execute();
			} catch (PDOException $e) {
				$error = $e->getMessage();
				print_r($error);
				// include '../public/error.html';
				exit;
			}

			return $this->stmt->fetchAll();
		}

		




		public function paginate($itemsPerPage)
		{	
			define(PARTOFLINK, '&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn=');
			define(ENDOFLINK,  '</a> &nbsp;');
			define(ENDANCHOR,  '">');
			
			$this->stmt = $this->pdo->query("SELECT * FROM blog_posts");					
			$numberOfRows = $this->stmt->rowCount();
			/*clean url for non-Number characters*/
			if (isset($_GET['pn'])) {$pageNumber = preg_replace('#[^0-9]#i', '', $_GET['pn']);} else {$pageNumber = 1;}

			
			$lastPage = ceil($numberOfRows / $itemsPerPage);
			/*--Force pageNumber to be within range--*/
			if ($pageNumber < 1) {$pageNumber = 1;} elseif ($pageNumber > $lastPage) {$pageNumber = $lastPage;}

			/*--Create clickable value for ?pn=$1 --*/
			$centerPages = "";
			$sub1 = $pageNumber - 1;
			$sub2 = $pageNumber - 2;
			$add1 = $pageNumber + 1;
			$add2 = $pageNumber + 2;


			define(PAGEACTIVE, '&nbsp; <span class="pagNumActive">'. $pageNumber . '</span>&nbsp;');


			if ($pageNumber == 1) {
				$centerPages .= PAGEACTIVE;
				$centerPages .= PARTOFLINK.$add1.ENDANCHOR.$add1.ENDOFLINK;
			}elseif ($pageNumber == $lastPage) {
				$centerPages .= PARTOFLINK.$sub1.ENDANCHOR.$sub1.ENDOFLINK;
				$centerPages .= PAGEACTIVE;
			}
			elseif ($pageNumber > 2 && $pageNumber < ($lastPage - 1)) {
				$centerPages .= PARTOFLINK.$sub2.ENDANCHOR.$sub2.ENDOFLINK;
				$centerPages .= PARTOFLINK.$sub1.ENDANCHOR.$sub1.ENDOFLINK;
				$centerPages .= PAGEACTIVE;
				$centerPages .= PARTOFLINK.$add1.ENDANCHOR.$add2.ENDOFLINK;
				$centerPages .= PARTOFLINK.$add1.ENDANCHOR.$add1.ENDOFLINK;
			}
			elseif ($pageNumber > 1 && $pageNumber < $lastPage) {
				$centerPages .= PARTOFLINK.$sub1.ENDANCHOR.$sub1.ENDOFLINK;
				$centerPages .= PAGEACTIVE;
				$centerPages .= PARTOFLINK.$add1.ENDANCHOR.$add1.ENDOFLINK;	
			}
			$limit = 'LIMIT ' . ($pageNumber - 1) * $itemsPerPage . ',' . $itemsPerPage;

			$this->stmt = $this->pdo->query("SELECT * FROM blog_posts ORDER BY postID DESC $limit");

			/* ----- Rendering -----*/
			$paginationDisplay = "";
			
			if ($lastPage != 1) {
				$paginationDisplay .= 'Page {<strong>'.$pageNumber.'</strong> of '.$lastPage . '}';
				if ($pageNumber != 1) {
					$previous = $pageNumber - 1;
					$paginationDisplay .= PARTOFLINK . $previous.'"> Back</a>';
				}
				$paginationDisplay .= '<span class="paginationNumbers">'.$centerPages.'</span>';
			}
			if ($pageNumber != $lastPage) {
				$nextPage = $pageNumber + 1;
				$paginationDisplay .= PARTOFLINK .$nextPage.'"> Next</a>';
			}		
			
			echo $paginationDisplay;
			return $this->stmt;
		}
//ASSET is hardcoded here for absolute path 
	public function trimPost($post, $postUrl)
	{		
			$words = explode(" ", $post, 51);
			if(count($words) == 51) {
				$words[50] = '<br><br><a class="btn btn-primary" href="' . ASSET . 'blog/' . $postUrl . '">' . 'Read More' . '</a>';
			}
			$string = implode(" ", $words);
			return $string;
	}

	public function postDate($date)
	{
		$phpdate       = strtotime($date);
		$formattedDate =  date('j M Y', $phpdate);
		echo $formattedDate;
	}


	public function generateUrl($s) 
	{
		$from = explode (',', "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,(,),[,],'");
		$to = explode (',', 'c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,,,,,,');
		$s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($s)));
		return strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '', $s)));
	}


	/*========================================================================================================================
		==========================================================================================================================
		==========================================CATEGORY STUFF =================================================================*/
		public function addCategory($category) 
		{
			try {		
				$sql = 'INSERT INTO blog_categories SET
				 				category  = :category';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':category', $category);
				$stmt->execute();
			} catch (PDOException $e) {
					$error = 'Unable to add category to database.'. $e->getMessage();
					include '../../public/error.html';
					exit();
			}
		}


		public function updateCategory($category, $categoryID) 
		{
			try {	
				$sql = 'UPDATE blog_categories SET
				 				category   		   = :category
				 				WHERE categoryID = :id';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':category', $category);			
				$stmt->bindValue(':id'      , $categoryID);
				$stmt->execute();
			} catch (PDOException $e) {
					$error = 'Unable to update author to database.'. $e->getMessage();
					include '../../public/error.html';
					exit();		
			}
		}


		public function deleteCategory($categoryID) 
		{
			try {
				$sql = 'DELETE FROM blog_categories WHERE categoryID = :id';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':id', $categoryID);
				$stmt->execute();
			} catch (PDOException $e) {
					$error = 'Error deleting category: ' . $e->getMessage();
					include '../../public/error.html';
					exit;
			}
		}


		/*========================================================================================================================
		==========================================================================================================================
		==========================================CATEGORY STUFF =================================================================*/



/*========================================================================================================================
		==========================================================================================================================
		==========================================AUTHOR STUFF =================================================================*/

		public function authorAdd($username, $email, $password, $image='photo0055_001_001.jpg') {
			
			try {				
				$sql = 'INSERT INTO blog_members SET		 						 						 			
				 				username  = :username,
				 				password  = :password,
				 				email 	  = :email,
				 				image 		= :image,
				 				join_date = CURDATE()';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':username', $username);
				$stmt->bindValue(':email'   , $email);
				$stmt->bindValue(':password', $password);
				$stmt->bindValue(':image'   , $image);
				$stmt->execute();
			} catch (PDOException $e) {
					$error = 'Unable to add author to database.'. $e->getMessage();
					// include '../../public/error.html';
					print_r($error);
					exit();		
			}

		}

		/*check for entered data*/
		// public function checkAuthorValues($username, $email, $password) {

		// 	$POSTValuesToCheck = array('username', 'email', 'password');
		// 	foreach ($POSTValuesToCheck as $key) {
		// 		if(!strlen($_POST[$key])) {
		// 			$err =  'Please enter ' . $key;
		// 			$action = 'add Author';
		// 			$username = $_POST['username'];
		// 			$email 		= $_POST['email'];
		// 			$password = $_POST['password'];
		// 			include 'form.html';
		// 			exit;
		// 		}			
		// 	}
		// }

		public function authorUpdate($id, $username, $email, $password) {

			try {		
				$sql = 'UPDATE blog_members SET
				 				username   		 = :username,
				 				password  		 = :password,
				 				email 	 		   = :email
				 				WHERE memberID = :id';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':username', $username);
				$stmt->bindValue(':password', $password);
				$stmt->bindValue(':email'   , $email);
				$stmt->bindValue(':id'      , $id);
				$stmt->execute();
			} catch (PDOException $e) {
					$error = 'Unable to update author to database.'. $e->getMessage();
					include '../../public/error.html';
					exit();		
			}
		}


		/*delete member finally*/
		public function authorDelete($id) {

			try {						
				$sql = 'DELETE FROM blog_members WHERE memberID = :id';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':id', $id);
				$stmt->execute();
			} catch (PDOException $e) {
					$error = 'Error deleting member: ' . $e->getMessage();
					include '../../public/error.html';
					exit;
			}
		}
/*========================================================================================================================
		==========================================================================================================================
		==========================================AUTHOR STUFF =================================================================*/

		/*========================================================================================================================
		==========================================================================================================================
		========================================== POST STUFF =================================================================*/

	/*-------------------Update Post--------------------*/
		public function postUpdate($title, $category, $url, $editor1, $post_id, $categoryID, $keyword, $description)
		{
			try {
				$sql = 'UPDATE blog_posts SET
				 				postTitle    = :title,
				 				postCategory = :category,
				 				postCont 		 = :post,
				 				postUrl 		 = :postUrl,
				 				postUpdate   = CURDATE(),
				 				keyword = :keyword,
				 				description = :description
				 				WHERE postID = :id';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':title', $title);
				$stmt->bindValue(':category', $category);
				$stmt->bindValue(':postUrl', $url);
				$stmt->bindValue(':post', $editor1);
				$stmt->bindValue(':keyword', $keyword);
				$stmt->bindValue(':description', $description);
				$stmt->bindValue(':id', $post_id);				
				$stmt->execute();

			/* drop post from category_publish */
				$sql = 'DELETE FROM category_publish WHERE post_id = :id';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':id', $post_id);
				$stmt->execute();

			/* re-enter post into category_publish */
				$sql = 'INSERT INTO category_publish SET
								category_id = :category_id,
								post_id = :post_id';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':category_id', $categoryID);
				$stmt->bindValue(':post_id', $post_id);
				$stmt->execute();
			} catch (PDOException $e) {
					$error = 'Unable to add to category_publish database.'. $e->getMessage();
					// include '../../public/error.html';
					echo $error;
					exit();
			}

		}
		/*------------------Insert into database----------------*/
		public function postInsert($title, $category, $editor1, $url, $author, $authorID, $categoryID, $keyword, $description)
		{
			try {
				$sql = 'INSERT INTO blog_posts SET
				 				postTitle = :title,
				 				postCategory = :category,
				 				postCont = :post,
				 				postAuthor = :author_name,
				 				postUrl = :postUrl,
				 				postDate = CURDATE(),
				 				keyword = :keyword,
				 				description = :description';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':title', $title);
				$stmt->bindValue(':category', $category);
				$stmt->bindValue(':post', $editor1);
				$stmt->bindValue(':postUrl', $url);
				$stmt->bindValue(':author_name', $author);
				$stmt->bindValue(':keyword', $keyword);
				$stmt->bindValue(':description', $description);
				$stmt->execute();


				$lastId = $this->pdo->lastInsertId();
				/* insert into author_publish */		
				$sql = 'INSERT INTO author_publish SET
								author_id = :author,
								post_id = :post_id';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':author', $authorID);
				$stmt->bindValue(':post_id', $lastId);
				$stmt->execute();
			




				/* insert into category_publish */			
				$sql = 'INSERT INTO category_publish SET
								category_id = :category_id,
								post_id = :post_id';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':category_id', $categoryID);
				$stmt->bindValue(':post_id', $lastId);
				$stmt->execute();

			} catch (PDOException $e) {
					$error = 'Unable to add to category_publish database.'. $e->getMessage();
					include '../../public/error.html';
					exit();
			}


		}


		/*---------------- Delete post------------------*/
		public function postDelete($postID)
		{
			try {						
				$sql 	= 'DELETE FROM blog_posts WHERE postID = :id';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':id', $postID);
				$stmt->execute();

				//Delete author-publish
				$sql 	= 'DELETE FROM author_publish WHERE post_id = :id';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':id', $postID);
				$stmt->execute();

				//Delete category publish
				$sql 	= 'DELETE FROM category_publish WHERE post_id = :id';
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindValue(':id', $postID);
				$stmt->execute();

			} catch (PDOException $e) {
					$error = 'Error deleting post: ' . $e->getMessage();
					include '../../public/error.html';
					exit;
			}
		}
}