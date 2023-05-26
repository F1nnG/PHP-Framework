<?php

namespace App\Models;

use Framework\Database\Model;
use App\Models\User;

class Tag extends Model
{
	public function users()
	{
		return $this->manyToMany(User::class, 'user_tags', 'tag_id', 'user_id');
	}
}