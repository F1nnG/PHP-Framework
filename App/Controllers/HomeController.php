<?php

namespace App\Controllers;

use App\Services\HomeService;

class HomeController
{
	public function show()
	{
		HomeService::showHomepage();
	}
}