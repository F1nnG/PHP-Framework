<?php

namespace App\Models;

use Framework\Database\Model;

class User extends Model
{
	public function profile()
	{
		return $this->oneToOne(Profile::class);
	}

	public function posts()
	{
		return $this->oneToMany(Post::class);
	}

	public function tags()
	{
		return $this->manyToMany(Tag::class, 'user_tags', 'user_id', 'tag_id');
	}
}