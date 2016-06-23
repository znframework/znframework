<?php
class Session extends StaticAccess
{
	const CONFIG_NAME = 'Services:session';

	public static function getClassName()
	{
		return __CLASS__;
	}
}