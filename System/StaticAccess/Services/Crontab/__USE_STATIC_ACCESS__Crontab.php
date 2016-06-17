<?php
class Crontab extends StaticAccess
{
	const CONFIG_NAME = 'Services:crontab';

	public static function getClassName()
	{
		return __CLASS__;
	}
}