<?php

namespace App\Services;

use Framework\Routing\Request;
use Framework\Views\View;
use Framework\Helpers\Link;
use App\Models\User;

class UserService
{
	public static function index()
	{
		return View::render('user.index', [
			'Link' => Link::class,
			'users' => User::all(),
		]);
	}

	public static function create()
	{
		return View::render('user.create-user', [
			'Link' => Link::class,
		]);
	}

	public static function show(User $user)
	{
		return View::render('user.show-user', [
			'Link' => Link::class,
			'user' => $user,
		]);
	}

	public static function edit(User $user)
	{
		return View::render('user.edit-user', [
			'Link' => Link::class,
			'user' => $user,
		]);
	}

	public static function store(Request $request)
	{
		User::Factory()->state([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'age' => $request->input('age'),
		])->create();

		return Link::redirect('/');
	}

	public static function update(Request $request, User $user)
	{
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->age = $request->input('age');

		$user->save();

		return Link::redirect('/');
	}

	public static function destroy(User $user)
	{
		$user->delete();

		return Link::redirect('/users');
	}
}