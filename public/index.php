<?php

require '../vendor/autoload.php';

use Framework\Routing\Route;
use Framework\Routing\Request;
use App\Routes\Web;

if (isset($_REQUEST['url'])) {
	$route = new Route();
	$web = new Web($route);

	$route->route(
		new Request($_REQUEST, $_SERVER)
	);
} else {
	echo 'No query string';
}
