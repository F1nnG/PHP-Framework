<?php

namespace App\Routes;

use Framework\Routing\Route;
use Framework\Routing\Request;
use App\Database\Migrations\Migration;
use App\Models\User;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Tag;

class Web
{
	public function __construct(Route $route)
	{
		$route->get('/test', function() {
			echo 'hallo';
		});

		$route->get('/test2', function(Request $request) {
			Migration::run();

			$user = User::Factory()->create();
			$profile = Profile::Factory()->create();
			$user->profile()->attach($profile);
			$posts = Post::Factory(5)->create()->items;
			foreach ($posts as $post) {
				$user->posts()->attach($post);
			}

			$tags = Tag::Factory(5)->create();

			echo '<pre>';
			print_r($posts);
			// print_r($user);
			// print_r($profile);
			// print_r($posts);
			echo '</pre>';
		});
	}
}
