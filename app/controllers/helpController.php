<?php

class helpController extends Controller
{

	public function index()
	{
		$data['msg'] = 'This is the help page';
		$data['title'] = 'Help Page';
		$data['heading'] = $data['title'];
		View::render('help/index', $data);

		$this->model = Controller::call_model('Help_Model');
	}

	public function other($arg = '')
	{
		echo '<br>we are inside other';
		echo '<br>Parameter: ' . $arg;
	}

}