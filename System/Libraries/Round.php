<?php
/************************************************************/
/*                     LIBRARY ROUND                        */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* ROUND                                                                               	  *
*******************************************************************************************
| Sınıfı Kullanırken : round::, $this->round, zn::$use->round, uselib('round')	  	  	  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class Round
{
	// Function: data()
	// İşlev: Sayıları yuvarlamak için kullanılır.
	// Parametreler
	// @number = Yuvarlanacak sayı.
	// @count = Virgülden sonraki ondalıklı bölmün kaç karakter olacağı
	// @type = Yuvarlamanın yönü. Parametrenin alabileceği değerler: average, down, up
	// Dönen Değer: Yuvarlanmı sayısal veri.
	public static function data($number = '', $count = 0, $type = "average")
	{
		if( ! is_numeric($number) || empty($number) ) 
		{
			return false;
		}
		
		if( ! is_numeric($count) ) 
		{
			$count = 0;
		}
		
		if( ! is_string($type) ) 
		{
			$type = "average";
		}
		
		if( is_int($number) )
		{ 
			return $number;
		}
		
		if( $type === 'average' )
		{
			return round($number, $count);
		}
		
		if( $type === 'down' )
		{
			if( $count == 0 ) 
			{
				return floor($number);	
			}
			
			$numbers = explode(".", $number);
			
			$edit = 0;
			
			if( ! empty($numbers[1]) )
			{
				$edit = substr($numbers[1], 0, $count);
				
				return (float)$numbers[0].".".$edit;
			}
		}
		if( $type === 'up' )
		{
			if($count == 0)
			{ 
				return ceil($number);
			}
			
			$numbers = explode(".", $number);
			
			$edit = 0;
			
			if( ! empty($numbers[1]) )
			{
				$edit = substr($numbers[1], 0, $count);
				
				return (float)$numbers[0].".".($edit + 1);
			}	
		}		
	}
}