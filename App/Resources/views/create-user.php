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
		<input type="text" name="name" placeholder="name">
		<input type="submit" value="Create">
	</form>
</body>
</html>