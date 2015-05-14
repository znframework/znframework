<?php
/************************************************************/
/*                 FORM SECURITY COMPONENT                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class ComponentFormSecurity
{
	protected function xss_encode($value)
	{
		return zn::$use->sec->xss_encode($value);
	}
	
	protected function nc_encode($value)
	{
		return zn::$use->sec->nc_encode($value);
	}
	
	protected function injection_encode($value)
	{
		return zn::$use->sec->injection_encode($value);
	}
	
	protected function html_encode($value)
	{
		return zn::$use->sec->html_encode($value);
	}
}