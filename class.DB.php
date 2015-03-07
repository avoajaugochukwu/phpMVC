<?php

/* Main database connection */
	/**
	* @abstract this file includes  shopDbclass.php after running
	* @author Avoaja Ugochukwu
	*/
class DB
{
	
	public function db()
	{
		try {
			$this->pdo = new PDO('mysql:host=localhost;dbname=biitocom_simpleblog', 'biitocom_avoaja', '19901105');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo->exec('SET NAMES "utf8"');
		}

		catch (PDOException $e) {
			$error = 'Unable to connect to database.'. $e->getMessage();
			include '../public/error.html';
			exit();
		}		

		return $this->pdo;
	}

	



}
?>