<?php
	class Model {
		public $db;
		function __construct() {
			// $this->db = new Fetch;
		}

		protected function getDb()
		{
			return $this->db = new Fetch;
		}


		
}