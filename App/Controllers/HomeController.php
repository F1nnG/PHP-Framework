<?php

namespace App\Controllers;

use Framework\Views\View;

class HomeController
{
	public function show()
	{
		return View::render('home', [
			'maker' => 'Finn',
		]);
	}
}