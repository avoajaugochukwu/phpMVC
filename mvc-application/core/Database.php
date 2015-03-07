<?php
class Database
{	
	public function db()
	{
		try {
			$this->pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo->exec('SET NAMES "utf8"');
		}
		catch (PDOException $e) {
			require_once CONTROLLER . 'errorController' . EXT;
			$error = new errorController;
			$error->db_error('Database connection failed' . $e->getMessage());
			exit;
		}

		if (!empty($this->pdo))
		{
			// echo 'Database ready <br>';
			return $this->pdo;
		}
	}



}

