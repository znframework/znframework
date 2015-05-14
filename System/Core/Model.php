<?php
/************************************************************/
/*                   MODEL CONTROLLERS                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Model
{
	public function __construct()
	{
		// necessary to use parent::__construct()
	}
	
	public function __get($key)
	{
		return zn::$dynamic->$key;
	}
}