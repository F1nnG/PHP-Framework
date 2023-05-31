<?php

namespace App\Services;
use Framework\Views\View;

class HomeService
{
	public static function showHomepage()
	{
		return View::render('home', [
			'maker' => 'Finn',
		]);
	}
}