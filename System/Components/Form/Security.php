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
	protected function xssEncode($value)
	{
		return security::xssEncode($value);
	}
	
	protected function ncEncode($value)
	{
		return security::ncEncode($value);
	}
	
	protected function injectionEncode($value)
	{
		return security::injectionEncode($value);
	}
	
	protected function htmlEncode($value)
	{
		return security::htmlEncode($value);
	}
}