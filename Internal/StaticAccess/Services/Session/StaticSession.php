<?php
class Session extends ZN\Foundations\UseStaticAccess
{
	const CONFIG_NAME = 'Services:session';

	public static function getClassName()
	{
		return __CLASS__;
	}
}