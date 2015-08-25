<?php
class __USE_STATIC_ACCESS__Round
{
	/***********************************************************************************/
	/* ROUND LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Round
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: round::, $this->round, zn::$use->round, uselib('round')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "Round::$method()"));	
	}
	
	// Function: data()
	// İşlev: Sayıları yuvarlamak için kullanılır.
	// Parametreler
	// @number = Yuvarlanacak sayı.
	// @count = Virgülden sonraki ondalıklı bölmün kaç karakter olacağı
	// @type = Yuvarlamanın yönü. Parametrenin alabileceği değerler: average, down, up
	// Dönen Değer: Yuvarlanmı sayısal veri.
	public function data($number = '', $count = 0, $type = "average")
	{
		if( ! is_numeric($number) || empty($number) ) 
		{
			return Error::set(lang('Error', 'numericParameter', 'number'));
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