<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Creation</title>
</head>
<body>
	<h1>Create a new User</h1>
	<form action="<?= $Link::get('users.store') ?>" method="post">
		<label for="name">Name:</label>
		<input type="text" name="name" placeholder="name"><br><br>
		<label for="email">Email:</label>
		<input type="email" name="email" placeholder="email"><br><br>
		<label for="age">Age:</label>
		<input type="number" name="age" placeholder="age"><br><br><br>
		<input type="submit" value="Create">
	</form>
</body>
</html>