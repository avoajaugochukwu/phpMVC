<?php

class homeController extends Controller
{

	public function index()
	{
		$data['title'] = 'MVC Home page';
		$data['heading'] = $data['title'];
		$data['msg'] = 'I am here now';


		View::render('home/index', $data);
	}

}
