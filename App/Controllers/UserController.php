<?php

namespace App\Controllers;

use Framework\Routing\Request;
use App\Services\UserService;
use App\Models\User;

class UserController
{
	public function index()
	{
		UserService::index();
	}

	public function create()
	{
		UserService::create();
	}

	public function show(User $user)
	{
		UserService::show($user);
	}

	public function edit(User $user)
	{
		UserService::edit($user);
	}

	public function store(Request $request)
	{
		UserService::store($request);
	}

	public function update(Request $request, User $user)
	{
		UserService::update($request, $user);
	}

	public function destroy(User $user)
	{
		UserService::destroy($user);
	}
}