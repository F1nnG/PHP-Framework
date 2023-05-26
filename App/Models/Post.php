<?php

namespace App\Models;

use Framework\Database\Model;
use App\Models\User;

class Post extends Model
{
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}