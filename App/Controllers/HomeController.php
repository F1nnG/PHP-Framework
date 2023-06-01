<?php

namespace App\Controllers;

use App\Services\HomeService;
use Framework\Routing\Request;

class HomeController
{
	public function show(Request $request)
	{
		HomeService::showHomepage();
	}
}