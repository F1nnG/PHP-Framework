<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Edit</title>
</head>
<body>
	<h1>Edit User</h1>
	<form action="<?= $Link::get('users.update', $user->id) ?>" method="post">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" placeholder="name" value="<?= $user->name ?>"><br><br>
		<label for="email">Email:</label>
		<input type="email" name="email" id="email" placeholder="email" value="<?= $user->email ?>"><br><br>
		<label for="age">Age:</label>
		<input type="number" name="age" id="age" placeholder="age" value="<?= $user->age ?>"><br><br><br>
		<input type="submit" value="Save">
	</form>
</body>
</html>