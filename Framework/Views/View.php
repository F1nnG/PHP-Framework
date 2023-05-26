<?php

namespace Framework\Views;

class View
{
	static public function render($view, $data = [])
	{
		$loader = new \Twig\Loader\FilesystemLoader('../app/resources/views');
		$twig = new \Twig\Environment($loader);

		$template = $twig->load($view . '.twig');
		$twig->display($template, $data);
	}
}