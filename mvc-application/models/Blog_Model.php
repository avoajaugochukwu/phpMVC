<?php

class Blog_Model extends Model {

		function __construct() {
			$this->connect = $this->getDb();
		}

		public function get_recent_posts()
		{

			$result = $this->connect->recentPost('blog_posts', 1, 'DESC', 0, 100);

			foreach ($result as $row) {
				$recents[] = array(
											'postTitle' => $row['postTitle'],
											'postUrl'	 => $row['postUrl'],
											'postAuthor' => $row['postAuthor'],
											'postContent' => $this->connect->trimPost($row['postCont'], $row['postUrl'])
					);
			}
			return $recents;
		}

		public function get_specific_post($request)
		{
			$result  = $this->connect->fetchWhere('blog_posts', 'blog_members', 'postUrl', $request);

			$arr = [];

			foreach ($result as $row) {
				$arr['post_id'] 				= $row['postID'];
				$arr['post_title'] 		= $row['postTitle'];
				$arr['post_category']  = $row['postCategory'];
				$arr['post_content']   = $row['postCont'];
				$arr['post_author'] 		= $row['postAuthor'];
				$arr['post_date']			= $row['postDate'];
				// $author_image 	= $row['image'];
				// $keyword				= $row['keyword'];
				// $description		= $row['description'];
			}


			return $arr;
		}

}