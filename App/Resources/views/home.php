<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
</head>
<body>
	<h1>PHP-Framework</h1>
	<p>Framework Maker: Finn</p>

	<a href="<?= $Link::get('users.index') ?>"><h1>Users</h1></a>

	<h2>Console commands:</h2>
	<h4>- php artisan migrate</h4>
	<p>This will migrate the database tables to the database.</p>
	<h4>- php artisan migrate --fresh</h4>
	<p>This will drop all the tables and migrate the database tables to the database.</p>
	<h4>- php artisan seed</h4>
	<p>This will seed the database with the seeders.</p>
	<h4>- php artisan make:controller</h4>
	<p>This will create a controller.</p>
	<h4>- php artisan make:service</h4>
	<p>This will create a service.</p>
	<h4>- php artisan make:model</h4>
	<p>This will create a model.</p>
	<h4>- php artisan make:factory</h4>
	<p>This will create a factory.</p>
</body>
</html>