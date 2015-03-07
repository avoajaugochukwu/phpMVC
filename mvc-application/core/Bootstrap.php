<?php
	/**
	 * @author Avoaja ugochukwu
	 * @uses breaks up url and searches for controllers and methods || passing any parameters to the methods
	 */


class Bootstrap
	{
		protected $controller = 'homeController';

		protected $method = 'index';

		protected $params = [];

		public function __construct()
		{

			$url = $this->parseUrl();



			$file = CONTROLLER . $url[0] . 'Controller' . EXT;
			if (file_exists($file))
			{
				$this->controller = $url[0] . 'Controller';
				/** prepare admin dependencies */
				if ($url[0] === 'admin')
				{
					require_once CONTROLLER . 'adminController' . EXT;
					if (isset($url[1])){
						if ($url[1] === 'category')
						{
							require_once ADMIN_DEPENDENCIES . 'categoryController' . EXT;
						}
						elseif ($url[1] === 'post')
						{
							require_once ADMIN_DEPENDENCIES . 'postController' . EXT;
						}
						elseif ($url[1] === 'author')
						{
						require_once ADMIN_DEPENDENCIES . 'authorController' . EXT;
						}
					}
				}


				unset($url[0]);
				require_once $file;
			}
			else {
				// $this->controller = 'homeController'; //default
				require_once CONTROLLER . $this->controller . EXT;
			}

			$this->controller = new $this->controller;


			// print_r(get_class_methods($this->controller));


			if (isset($url[1]))
			{

				if (method_exists($this->controller, $url[1]))
				{
					// $this->method = 'index'; 
					$this->method = $url[1];
					unset($url[1]);
				}

			}

			// print_r($url);

			$this->params = $url ? array_values($url) : [];

			call_user_func_array([$this->controller, $this->method], $this->params);
		}


		public function parseUrl()
		{
			if (isset($_GET['url']))
			{
				return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));

			}
		}
	}