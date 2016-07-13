<?php
class Session extends ZN\Foundations\StaticAccess
{
	const CONFIG_NAME = 'Services:session';

	public static function getClassName()
	{
		return __CLASS__;
	}
}