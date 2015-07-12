<?php
class Strings
{
	/***********************************************************************************/
	/* STRINGS LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Strings
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: strings::, $this->strings, zn::$use->strings, uselib('strings')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
	| Örnek Kullanım: trimSlashes('/abc bcd/'); // abc bcd         						  |
	|          																				  |
	******************************************************************************************/
	public static function trimSlashes($str = '')
	{
		if( ! is_string($str) ) 
		{
			return false;
		}
		
		$str = trim($str, "/");
		
		return $str;
	}	
	
	/******************************************************************************************
	* CASING CONVERTER                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Küçük büyük harf dönüştürmeleri yapmak için kullanılır.			  	  |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 2. [ string var @type ] => Dönüşümün tipi. Varsayılan:lower					     	  |
	| 3. [ string var @encoding ] => Dönüşümün karakter seti. Varsayılan:utf-8				  |
	|       																				  |
	| Kullanılabilir Dönüşüm Tipleri: lower, upper, title   								  |
	|																						  |
	| Örnek Kullanım:  																	      |
	| echo casing('Zn Kod Çatısına Hoş'); // Çıktı: zn kod çatısına hoş				  |
	| echo casing('Zn Kod Çatısına Hoş', 'upper'); // Çıktı: ZN KOD ÇATISINA HOŞ	  |
	| echo casing('Zn Kod Çatısına Hoş', 'title'); // Çıktı: Zn Kod Çatısına Hoş	  |
	|       																				  |
	******************************************************************************************/
	public static function casing($str = '', $type = 'lower', $encoding = "utf-8")
	{
		return Covert::stringCase($str, $type, $encoding);
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
	| Örnek Kullanım: upperCase('zntr.net'); // ZNTR.NET         						      |
	|          																				  |
	******************************************************************************************/
	public static function upperCase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str) || ! isCharset($encoding) ) 
		{
			return false;
		}
		
		$str = mb_convert_case($str, MB_CASE_UPPER, $encoding);
		
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
	| Örnek Kullanım: upperCase('ZNTR.NET'); // zntr.net         						      |
	|          																				  |
	******************************************************************************************/
	public static function lowerCase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str) || ! isCharset($encoding) ) 
		{
			return false;
		}
		
		$str = mb_convert_case($str, MB_CASE_LOWER, $encoding);
		
		return $str;
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
	| Örnek Kullanım: titleCase('ZNTR.NET'); // Zntr.net         						      |
	|          																				  |
	******************************************************************************************/
	public static function titleCase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str) || ! isCharset($encoding) ) 
		{
			return false;
		}
		
		$str = mb_convert_case($str, MB_CASE_TITLE, $encoding);
		
		return $str;
	}
	
	/******************************************************************************************
	*  CAMELCASE                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: camelCase tipinde yazı elde etmek için kullanılır.		     		  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @str => Küçük harfe çevirelecek metin.								      |
	| 2. string var @encoding => Kodlama Türü.		    								      |
	|          																				  |
	| Örnek Kullanım: camelCase('ZNTR NET'); // zntrNet         						      |
	|          																				  |
	******************************************************************************************/
	public static function camelCase($str = '')
	{
		$string = self::titleCase($str);
		
		$string[0] = self::lowerCase($string);
		
		return self::mtrim($string);
	}	
	
	/******************************************************************************************
	*  PASCAL CASE                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: PascalCase tipinde yazı elde etmek için kullanılır.		     		  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @str => Küçük harfe çevirelecek metin.								      |
	| 2. string var @encoding => Kodlama Türü.		    								      |
	|          																				  |
	| Örnek Kullanım: pascalCase('ZNTR NET'); // zntrNet         						      |
	|          																				  |
	******************************************************************************************/
	public static function pascalCase($str = '')
	{
		$string = self::titleCase($str);
		
		return self::mtrim($string);
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
	| Örnek Kullanım: subString('ZNTR.NET', 0, 4); // ZNTR         						      |
	|          																				  |
	******************************************************************************************/
	public static function subString($str = '', $starting = 0, $count = 0, $encoding = "utf-8")
	{
		if( ! is_string($str) ) 
		{
			return false;
		}
		
		if( ! isChar($starting) ) 
		{
			$starting = 0;
		}
		
		if( ! isChar($count) ) 
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
		
		if( ! isValue($shuffle) || empty($shuffle) ) 
		{
			return $str;
		}
		
		if( ! isValue($reshuffle) ) 
		{
			return $str;
		}
		
		$shuffleEx = explode($shuffle, $str);
		
		$newstr = '';
		
		foreach($shuffleEx as $v)
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
	| Örnek Kullanım: string_recurrentCount('ZNTR.NET', 'N'); // 2               			  |
	|          																				  |
	******************************************************************************************/
	public static function recurrentCount($str = '', $char = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return false;
		}
		
		if( ! isValue($char) ) 
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
	| Örnek Kullanım: string_recurrentCount('ZNTR.NET', 'N', array('+', '-')); // Z+TR.-ET   |
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