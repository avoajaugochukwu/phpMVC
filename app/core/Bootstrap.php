<?php
	/**
	 * @author Avoaja ugochukwu
	 * @uses breaks up url and searches for controllers and methods || passing any parameters to the methods
	 * @todo use URL FILTER to clean url and protect for attacks
	 */


class Bootstrap {

	function __construct()
	{
		$this->controller = 'homeController';
		$this->method = 'index';
		$this->params = [];


		$url = isset($_GET['url']) ? $_GET['url'] : null;
		
		
		
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		
		/**
		 * @return if true url empty send to home page
		 */
		if (empty($url[0]))
		{
			// $this->controller = 'homeController';
			require CONTROLLER . $this->controller . EXT;

			//refactor
		}

		else 
		{
			$this->controller = $url[0] . 'Controller'; // requested controller and append Contoller 
			$file = CONTROLLER . $this->controller . EXT;

			if (!file_exists($file))
			{
				/**
		 			* check file existence if false throw error
		 		*/
				require_once CONTROLLER . 'errorController.php';
				$this->controller_error = new errorController;
				$this->controller_error->file_not_found_error();
				return false;
			}
		}

		/**
		 * initialise the controller
		 */
		require_once CONTROLLER . $this->controller . EXT;

		$this->controller = new $this->controller;

		if (!empty($url[1]))
		{
			if (method_exists($this->controller, $url[1]))
			{
				$this->method = $url[1];
				// clean url to leave only parameters
				unset($url[0]);
				unset($url[1]);
			}
		}


		$this->params = $url ? array_values($url) : [];
		// var_dump($this->params);
		echo "<pre>";
		var_export($this->controller);
		echo "</pre>";
		echo '<br>';
		echo "<pre>";
		var_export($this->method);
		echo "</pre>";
		echo '<br>';
		echo "<pre>";
		var_export($this->params);
		echo "</pre>";
		call_user_func_array([$this->controller, $this->method], $this->params);
	}

}