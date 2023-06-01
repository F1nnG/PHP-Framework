<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Users</title>
</head>
<body>
	<div>
		<h1><?= $user->name ?></h1>
		<p><?= $user->email ?></p>
		<p><?= $user->age ?></p>
		<a href="<?= $Link::get('users.index', $user->id) ?>">Back</a>
		<a href="<?= $Link::get('users.edit', $user->id) ?>">Edit</a>
		<a href="<?= $Link::get('users.destroy', $user->id) ?>">Delete</a>
	</div>
</body>
</html>