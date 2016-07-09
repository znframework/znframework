<?php
class Crontab extends ZN\Foundations\StaticAccess
{
	const CONFIG_NAME = 'Services:crontab';

	public static function getClassName()
	{
		return __CLASS__;
	}
}