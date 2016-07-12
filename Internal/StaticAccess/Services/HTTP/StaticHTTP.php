<?php
class HTTP extends ZN\Foundations\UseStaticAccess
{
	const CONFIG_NAME = 'Services:http';

	public static function getClassName()
	{
		return __CLASS__;
	}
}