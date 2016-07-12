<?php
class SSH extends ZN\Foundations\UseStaticAccess
{
	const CONFIG_NAME = 'Services:ssh';

	public static function getClassName()
	{
		return __CLASS__;
	}
}