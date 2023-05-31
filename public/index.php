<?php

require '../vendor/autoload.php';
require '../App/Routes/Web.php';

use Framework\Routing\Route;
use Framework\Routing\Request;

if (!isset($_REQUEST['url']))
	$_REQUEST['url'] = '';

session_start();
Route::route(new Request($_REQUEST, $_SERVER));
