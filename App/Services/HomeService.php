<?php

namespace App\Services;

use Framework\Views\View;
use Framework\Helpers\Link;

class HomeService
{
	public static function showHomepage()
	{
		return View::render('home', [
			'Link' => Link::class,
		]);
	}
}