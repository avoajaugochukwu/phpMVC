<?php
/**
*	@uses controller has to be initialized by child class
* like this parent::__construct
*/


class Controller {
	public static $called_model;
	public function __construct() {
	}


	public static function call_model($model)
	{
		require_once APP . 'models/' . $model . EXT;

		self::$called_model = new $model();
		return self::$called_model;
	}

	public function requireModel($model)
	{
		require_once APP . 'models/' . $model . EXT;
		$this->createdModel = new $model();
		return $this->createdModel;
	}



	public static function call_method($model, $method_name, $param = [])
	{
		//this is not dynamic use an array for variable number of paramters
		return call_user_func_array([$model, $method_name], $param);
		// return self::$called_model::$method_name($param1, $param2);
	}



}