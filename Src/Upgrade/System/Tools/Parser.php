<?php
/************************************************************/
/*                     TOOL PARSER                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: parser()
// İşlev: Değişken türü dönüştürücü.
// Parametreler
// @var = Türü dönüştürülecek veri.
// @type = Hangi türe dönüştürüleceği. Parametrenin alabileceği değerler: int/integer, bool/boolean, string, float, real, double, object, array, unset
// Dönen Değer: Dönüştürülmüş veri.
if(!function_exists('parser'))
{
	function parser($var = '', $type = 'int')
	{
		if( ! is_string($type)) return false;
		switch($type)
		{
			case 'int':
				return (int)$var;
			break;	
			
			case 'integer':
				return (integer)$var;
			break;	
			
			case 'bool':
				return (bool)$var;
			break;	
			
			case 'boolean':
				return (boolean)$var;
			break;
			
			case 'str':
			case 'string':
				if(is_array($var) || is_object($var)) return $var;
				return (string)$var;
			break;
			
			case 'float':
				return (float)$var;
			break;
			
			case 'real':
				return (real)$var;
			break;
			
			case 'double':
				return (double)$var;
			break;
			
			case 'object':
				return (object)$var;
			break;
			
			case 'array':
				return (array)$var;
			break;
			
			case 'unset':
				return (unset)$var;
			break;
		}
	}
}
