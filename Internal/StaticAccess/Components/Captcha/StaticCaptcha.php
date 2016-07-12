<?php
class Captcha extends ZN\Foundations\UseStaticAccess
{
	const CONFIG_NAME = 'Components:captcha';

	public static function getClassName()
	{
		return __CLASS__;
	}
}