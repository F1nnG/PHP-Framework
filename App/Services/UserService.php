<?php

namespace App\Services;

use Framework\Routing\Request;
use Framework\Views\View;
use Framework\Helpers\Link;
use App\Models\User;

class UserService
{
	public static function create()
	{
		return View::render('create-user', [
			'Link' => Link::class,
		]);
	}

	public static function store(Request $request)
	{
		User::Factory()->state([
			'name' => $request->input('name'),
		])->create();

		return Link::redirect('/');
	}
}