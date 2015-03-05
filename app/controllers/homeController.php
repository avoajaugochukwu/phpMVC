<?php

class homeController extends Controller
{

	public function index()
	{
		$data['title'] = 'MVC Home page';
		$data['heading'] = $data['title'];
		$data['msg'] = 'I am here now';
		$data['description'] = 'Web design nigeria, best nigerian web designer, programmer';
		$data['keywords'] ='web design nigeria, PHP, UI, JavaScript, jQuery, CSS, HTML5, Python, Algorithm';


		View::render('home/index', $data);
	}

}
