<?php

namespace App\Database\Migrations;

use Framework\Database\Schema;
use Framework\Database\Blueprint;

class Migration {
	public static function run()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name');

			return $table;
		});

		Schema::create('profiles', function (Blueprint $table) {
			$table->id();
			$table->string('email');
			$table->foreignId('user_id')->nullable();

			return $table;
		});

		Schema::create('posts', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->text('content');
			$table->foreignId('user_id')->nullable();

			return $table;
		});

		Schema::create('tags', function (Blueprint $table) {
			$table->id();
			$table->string('name');

			return $table;
		});

		Schema::create('user_tags', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id');
			$table->foreignId('tag_id');

			return $table;
		});
	}
};