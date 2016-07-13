<?php
class FTP extends ZN\Foundations\StaticAccess
{
	const CONFIG_NAME = 'Services:ftp';

	public static function getClassName()
	{
		return __CLASS__;
	}
}