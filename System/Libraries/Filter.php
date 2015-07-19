<?php
class __USE_STATIC_ACCESS__Filter
{
	/***********************************************************************************/
	/* FILTER LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Filter
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: filter::, $this->filter, zn::$use->filter, uselib('filter')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	// Function: word_filter()
	// İşlev: Metin içinde istenilmeyen kelimelerin izole edilmesi için kullanılır.
	// Parametreler
	// @string = Filtrelenecek veri.
	// @badwords = Filtrelenmesi istenen kelime veya kelimeler. string veya array veri türü.
	// @changechar = Kötü içerikli kelimelerin yerini alacak yeni kelime veya kelimeler. string veya array veri türü.
	// Dönen Değer: Filtrelenmiş veri.
	public function word($string = '', $badWords = '', $changeChar = '[badwords]')
	{
		if( ! isValue($string) ) 
		{
			return false;
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
}