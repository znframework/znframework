<?php
/************************************************************/
/*                    LIBRARY STRINGS                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* STRINGS                                                                             	  *
*******************************************************************************************
| Sınıfı Kullanırken :	strings::, $this->strings, zn::$use->strings, uselib('strings')   |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class Strings
{
	/******************************************************************************************
	*  MTRIM                                                                    			  *
	*******************************************************************************************
	| Genel Kullanım: Verideki tüm boşlukları silmek için kullanılır.   	                  |
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @str => Boşlukları silinecek veri.			  					          |
	|          																				  |
	| Örnek Kullanım: mtrim(' abc bcd '); // abcbcd         						  		  |
	|          																				  |
	******************************************************************************************/
	public static function mtrim($str = '')
	{
		if( ! is_string($str) ) 
		{
			return false;
		}
		
		$str = preg_replace('/\s+/', '', $str);
		$str = preg_replace('/&nbsp;/', '', $str);
		
		return $str;
	}	

	/******************************************************************************************
	*  TRIM SLASHES                                                               			  *
	*******************************************************************************************
	| Genel Kullanım: Verinin başındaki veya sonundaki / taksim karakterlerini silmek 		  |
	| için kullanılır.   	                  											      |
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @str => Başındaki ve sonundaki / taksim işaretleri temizlenecek olan veri.|
	|          																				  |
	| Örnek Kullanım: trim_slashes('/abc bcd/'); // abc bcd         						  |
	|          																				  |
	******************************************************************************************/
	public static function trim_slashes($str = '')
	{
		if( ! is_string($str) ) 
		{
			return false;
		}
		
		$str = trim($str, "/");
		
		return $str;
	}	

	/******************************************************************************************
	*  UPPERCASE                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadeleri büyük harfe çevirir.   	                  		  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @str => Büyük harfe çevirelecek metin.								      |
	| 2. string var @encoding => Kodlama Türü.		    								      |
	|          																				  |
	| Örnek Kullanım: uppercase('zntr.net'); // ZNTR.NET         						      |
	|          																				  |
	******************************************************************************************/
	public static function uppercase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str) || ! is_charset($encoding) ) 
		{
			return false;
		}
		
		$str = mb_strtoupper($str, $encoding);
		
		return $str;
	}	

	/******************************************************************************************
	*  LOWERCASE                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadeleri küçük harfe çevirir.   	                  		  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @str => Küçük harfe çevirelecek metin.								      |
	| 2. string var @encoding => Kodlama Türü.		    								      |
	|          																				  |
	| Örnek Kullanım: uppercase('ZNTR.NET'); // zntr.net         						      |
	|          																				  |
	******************************************************************************************/
	public static function lowercase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str) || ! is_charset($encoding) ) 
		{
			return false;
		}
		
		$str = mb_strtolower($str, $encoding);
		
		return $str;
	}	
}

	/******************************************************************************************
	*  TITLECASE                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadelerin sadece ilk harfini büyük harfe çevirir.     		  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @str => Küçük harfe çevirelecek metin.								      |
	| 2. string var @encoding => Kodlama Türü.		    								      |
	|          																				  |
	| Örnek Kullanım: titlecase('ZNTR.NET'); // Zntr.net         						      |
	|          																				  |
	******************************************************************************************/
	public static function titlecase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str) || ! is_charset($encoding) ) 
		{
			return false;
		}
		
		$str = mb_convert_case($str, MB_CASE_TITLE, $encoding);
		
		return $str;
	}	

	/******************************************************************************************
	*  SUBSTRING                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: Substr kullanımıdır. Ancak parametreler noktasında küçük bir fark vardır|
	|																						  |
	| Parametreler: 4 parametresi vardır.                                              	      |
	| 1. string var @str => Kırpılacak metin.								                  |
	| 2. numeric/string var @starting => Kırpmaya kaçıncı karakterden başlnacağı. 			  |
	| Parametrenin alabileceği değerler: sayısal veriler, first, middle.					  |
	|	2.1- sayısal veriler: herhangi bir sayı.											  |
	|	2.2- first: ilk karakterden itibaren.												  |
	|	2.3- middle: ortanca karakterden itibaren.											  |
	| 3. numeric/string var @count => Kaç karakter kırpılacağı. 							  |
	| Parametrenin alabileceği değerler: sayısal veriler, all								  |
	| 	3.1- sayısal veriler: herhangi bir sayı.											  |
	| 	3.2- all: Kalan bütün karakterler..		    						                  |
	| 4. string var @encoding => Kodlama Türü.		    								      |
	|          																				  |
	| Örnek Kullanım: substring('ZNTR.NET', 0, 4); // ZNTR         						      |
	|          																				  |
	******************************************************************************************/
	public static function substring($str = '', $starting = 0, $count = 0, $encoding = "utf-8")
	{
		if( ! is_string($str) ) 
		{
			return false;
		}
		
		if( ! is_char($starting) ) 
		{
			$starting = 0;
		}
		
		if( ! is_char($count) ) 
		{
			$count = 0;
		}
		
		if( empty($count) )
		{ 
			return $str;
		}
		
		if( $starting === 'first' ) 
		{
			$starting = 0;
		}
		
		if( $starting === 'middle' ) 
		{
			$starting = floor(mb_strlen($str, $encoding) / 2);
		}
		
		if( $count === 'all') 
		{
			$count = mb_strlen($str, $encoding) - ($starting);
		}
		
		return mb_substr($str, $starting, $count, $encoding);
	}	

	/******************************************************************************************
	*  STRING SEARCH                                                              			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadeler içinde arama yapmak için kullanılır.     		      |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @str => Arama yapılacak metin.								              |
	| 2. string var @needle => Aranan karakter veya karakterler.		    				  |
	| 3. string var @type => Arama sonucunun türü. 											  |
	| Parametrenin alabileceği değerler: str/string veya pos/position.						  | 
	| 	3.1-str/string: aranan kelime bulunmuş ise bulunan veri döner.				          |
	| 	3.2-pos/position: aranan kelime bulunmuş ise bulunan verinin ilk karakterinin 		  |
	|   indeks numarası döner.   								          					  |
	|          																				  |
	| Örnek Kullanım: string_search('ZNTR.NET', 'NET'); // NET         						  |
	| Örnek Kullanım: string_search('ZNTR.NET', 'NET', 'pos'); // 5         				  |
	|          																				  |
	******************************************************************************************/
	public static function search($str = '', $needle = '', $type = "str")
	{
		if( ! is_string($str) ) 
		{
			return false;
		}
		
		if( ! is_string($type) ) 
		{
			$type = "str";
		}
		
		if( ! is_string($needle ) ) 
		{
			$needle = "";
		}
		
		if( $type === "str" || $type === "string" )
		{
			return strstr($str, $needle);
		}
		if($type === "pos" || $type === "position")
		{
			return strpos($str, $needle);
		}
	}	

	/******************************************************************************************
	*  STRING RESHUFFLE                                                           			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadeler içinde istenilen karaketerleri birbirleri ile 		  |
	| yer değiştirmek için kullanılır.     		      						  			      |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @str => Değişiklik yapılacak metin.								          |
	| 2. string var @shuffle => Yer değiştirilmesi istenen ilk karakter veya karakterler.	  |
	| 3. string var @reshuffle => Yer değiştirilmesi istenen ikinci karakter veya karakterler.|
	|          																				  |
	| Örnek Kullanım: string_reshuffle('ZNTR.NET', '.', 'N'); // Z.TRN.ET         			  |
	|          																				  |
	******************************************************************************************/
	public static function reshuffle($str = '', $shuffle = '', $reshuffle = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return false;
		}
		
		if( ! is_value($shuffle) || empty($shuffle) ) 
		{
			return $str;
		}
		
		if( ! is_value($reshuffle) ) 
		{
			return $str;
		}
		
		$shuffleex = explode($shuffle, $str);
		
		$newstr = '';
		
		foreach($shuffleex as $v)
		{
			$newstr .=  str_replace($reshuffle, $shuffle, $v).$reshuffle;	
		} 
		
		return substr($newstr, 0, -strlen($reshuffle));
	}	

	/******************************************************************************************
	*  STRING RECURRENT COUNT                                                      			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadelerde tekrarlayan karakter veya karakterlerin 			  |
	| sayısını öğrenmek için kullanılır.     		      						  			  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @str => Arama yapılacak metin.								         	  |
	| 2. string var @shuffle => Kaç kez tekrar ettiği hesaplanmak istenen karakter veya 	  |
	| karakterler.	  																		  |
	|          																				  |
	| Örnek Kullanım: string_recurrent_count('ZNTR.NET', 'N'); // 2               			  |
	|          																				  |
	******************************************************************************************/
	public static function recurrent_count($str = '', $char = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return false;
		}
		
		if( ! is_value($char) ) 
		{
			return $str;
		}
		
		return count(explode($char, $str)) - 1;
	}	

	/******************************************************************************************
	*  STRING PLACEMENT                                                          			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadeler içinde istenilen karakterlerin yerine başka 		  |
	| karakterler yerleştirmek için kullanılır.     		      						  	  |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @str => Değişiklik yapılacak metin.								          |
	| 2. string var @delimiter => Hangi karakterin yerine yerleştirme yapılacağı.	  		  |
	| 3. array var @array => Değiştirilmek istenen karakterler yerine sırasıyla hangi 
	| karakterlerin geleceği.	  		  													  |
	|          																				  |
	| Örnek Kullanım: string_recurrent_count('ZNTR.NET', 'N', array('+', '-')); // Z+TR.-ET   |
	|          																				  |
	******************************************************************************************/
	public static function placement($str = '', $delimiter = '?', $array = array())
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return false;
		}
		
		if( ! is_array($array) ) 
		{
			return false;
		}
		
		if( ! empty($delimiter) )
		{
			$strex = explode($delimiter, $str);
		}
		else
		{
			return $str;
		}
		
		if( (count($strex) - 1) !== count($array) )
		{
			return $str;
		}
		
		$newstr = '';
		
		for($i = 0; $i < count($array); $i++)
		{
			$newstr .= $strex[$i].$array[$i];
		}
	
		return $newstr.$strex[count($array)];
	}	
}