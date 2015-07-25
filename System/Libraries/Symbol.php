<?php
class __USE_STATIC_ACCESS__Symbol
{
	/***********************************************************************************/
	/* SYMBOL LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Symbol
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: symbol::, $this->symbol, zn::$use->symbol, uselib('symbol')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	*  NAME                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Config/Symbols.php dosyasında belirtilen özel sembolleri kullanabilmek  |
	| için kullanılır.														                  |
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @sybom_name => Config/Symbols.php dosyasındaki anahtar isimler.			  |
	|          																				  |
	| Örnek Kullanım: symbol('daimon');         											  |
	|          																				  |
	******************************************************************************************/	
	public function name($symbolName = 'turkishLira')
	{
		if( ! is_string($symbolName) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'symbolName'));
		}
		
		$symbol = Config::get('Symbols', $symbolName);
		
		if( ! empty($symbol) )
		{ 
			return $symbol; 
		}
		else
		{ 
			return false;
		}
	}	
}