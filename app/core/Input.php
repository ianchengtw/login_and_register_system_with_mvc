<?php
class Input
{
	public static function exists($method = 'post')
	{
		if ($method == 'post') {
			return (!empty($_POST)) ? true : false;
		} else if ($method == 'get') {
			return (!empty($_GET)) ? true : false;
		}
		return false;
	}

	public static function get($item)
	{
		if (isset($_POST[$item])) {
			return $_POST[$item];
		} else if (isset($_GET[$item])) {
			return $_GET[$item];
		}
		return '';
	}
}