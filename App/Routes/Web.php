<?php

namespace App\Routes;

use Framework\Routing\Route;
use App\Controllers\HomeController;

Route::get('/', [HomeController::class, 'show']);
