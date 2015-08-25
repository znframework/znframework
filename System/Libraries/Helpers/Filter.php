<?php
class __USE_STATIC_ACCESS__Filter
{
	/***********************************************************************************/
	/* FILTER LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Filter
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Filter::, $this->Filter, zn::$use->Filter, uselib('Filter')
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
		die(getErrorMessage('Error', 'undefinedFunction', "Filter::$method()"));	
	}
	
	/******************************************************************************************
	* WORD                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Metin içinde istenilmeyen kelimelerin izole edilmesi için kullanılır.   |
	|          																				  |
	******************************************************************************************/
	public function word($string = '', $badWords = '', $changeChar = '[badwords]')
	{
		if( ! isValue($string) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'string'));
		}
		
		if( ! is_array($badWords) ) 
		{
			if( empty($badWords) )
			{
				return $string;	
			}
			
			return  $string = Regex::replace($badWords, $changeChar, $string, 'xi');
		}
		
		$ch = '';
		$i = 0;	
		
		if( ! empty($badWords) ) foreach( $badWords as $value )
		{
			if( ! is_array($changeChar) )
			{
				$ch = $changeChar;
			}
			else
			{
				if( isset($changeChar[$i]) )
				{
					$ch = $changeChar[$i];	
					$i++;
				}
			}
			
			$string = Regex::replace($value, $ch, $string, 'xi');
		}

		return $string;
	}	
	
	/******************************************************************************************
	* DATA                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Filter::word() yöntemi ile aynı işlevi görür.     			          |
	|          																				  |
	******************************************************************************************/
	public function data($string = '', $badWords = '', $changeChar = '[badwords]')
	{
		return self::word($string, $badWords, $changeChar);
	}
}