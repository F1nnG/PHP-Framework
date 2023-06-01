<?php

namespace Framework\Views;

class View
{
	static public function render(string $view, array $data = []): void
	{
		extract($data);

		include('../app/resources/views/' . $view . '.php');
	}
}