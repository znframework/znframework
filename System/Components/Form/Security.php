<?php
/************************************************************/
/*                 FORM SECURITY COMPONENT                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Form;

use Security;
/******************************************************************************************
* PROTECTED SECURITY                                                                      *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Edilmez   		     							      |
| Sınıfı Kullanırken      :	Kullanılmaz      									 		  |
| 																						  |
| NOT: From kütüphanesine yardımcı sınıftır.     										  |
******************************************************************************************/
class ComponentFormSecurity
{
	protected function xss_encode($value)
	{
		return security::xss_encode($value);
	}
	
	protected function nc_encode($value)
	{
		return security::nc_encode($value);
	}
	
	protected function injection_encode($value)
	{
		return security::injection_encode($value);
	}
	
	protected function html_encode($value)
	{
		return security::html_encode($value);
	}
}