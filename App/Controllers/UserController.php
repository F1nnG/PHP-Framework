<?php

namespace App\Controllers;

use Framework\Routing\Request;
use App\Services\UserService;

class UserController
{
	public function create()
	{
		UserService::create();
	}

	public function store(Request $request)
	{
		UserService::store($request);
	}
}