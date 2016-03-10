<?php
class __USE_STATIC_ACCESS__Strings implements StringsInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Call Undefined Method                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// __call()
	//																						  
	//----------------------------------------------------------------------------------------------------
	use CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control
	//----------------------------------------------------------------------------------------------------
	// 
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use ErrorControlTrait;
	
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
	public function mtrim($str = '')
	{
		if( ! is_string($str) ) 
		{
			return Errors::set('Error', 'stringParameter', '1.(str)');
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
	public function trimSlashes($str = '')
	{
		if( ! is_string($str) ) 
		{
			return Errors::set('Error', 'stringParameter', '1.(str)');
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
	public function casing($str = '', $type = 'lower', $encoding = "utf-8")
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
	public function upperCase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str) || ! isCharset($encoding) ) 
		{
			Errors::set('Error', 'stringParameter', '1.(str)');
			Errors::set('Error', 'charsetParameter', '2.(encoding)');
			
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
	public function lowerCase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str) || ! isCharset($encoding) ) 
		{
			Errors::set('Error', 'stringParameter', '1.(str)');
			Errors::set('Error', 'charsetParameter', '2.(encoding)');
			
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
	public function titleCase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str) || ! isCharset($encoding) ) 
		{
			Errors::set('Error', 'stringParameter', '1.(str)');
			Errors::set('Error', 'charsetParameter', '2.(encoding)');
			
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
	public function camelCase($str = '')
	{
		$string = $this->titleCase($str);
		
		$string[0] = $this->lowerCase($string);
		
		return $this->mtrim($string);
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
	public function pascalCase($str = '')
	{
		$string = $this->titleCase($str);
		
		return $this->mtrim($string);
	}

	/******************************************************************************************
	* SECTION                  	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dizgenin bir alt dizgesini alır.										  | 
		
	  @param  string  $str 
	  @param  string  $starting
	  @param  numeric $count NULL
	  @param  string  $encoding utf-8 
	  @return string
	|														                                  |
	******************************************************************************************/
	public function section($str = '', $starting = 0, $count = NULL, $encoding = "utf-8")
	{
		if( ! is_string($str) ) 
		{
			return Errors::set('Error', 'stringParameter', '1.(str)');
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
	| 4. string var @case => False ayarlanırsa büyük-küçük harf duyarlılığına bakılmaz.		  |
	|          																				  |
	| Örnek Kullanım: string_search('ZNTR.NET', 'NET'); // NET         						  |
	| Örnek Kullanım: string_search('ZNTR.NET', 'NET', 'pos'); // 5         				  |
	|          																				  |
	******************************************************************************************/
	public function search($str = '', $needle = '', $type = "str", $case = true)
	{
		if( ! is_string($str) || ! is_string($needle) || ! is_string($type) ) 
		{
			return Errors::set('Error', 'stringParameter', '1.(str) & 2.(neddle) & 3.($type)');
		}
		
		if( $type === "str" || $type === "string" )
		{
			if( $case === true )
			{
				return mb_strstr($str, $needle);
			}
			else
			{
				return mb_stristr($str, $needle);
			}
		}
		if($type === "pos" || $type === "position")
		{
			if( $case === true )
			{
				return mb_strpos($str, $needle);
			}
			else
			{
				return mb_stripos($str, $needle);
			}
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
	public function reshuffle($str = '', $shuffle = '', $reshuffle = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return Errors::set('Error', 'stringParameter', '1.(str)');
		}
		
		if( ! is_scalar($shuffle) || empty($shuffle) ) 
		{
			return $str;
		}
		
		if( ! is_scalar($reshuffle) ) 
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
	public function recurrentCount($str = '', $char = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return Errors::set('Error', 'stringParameter', '1.(str)');
		}
		
		if( ! is_scalar($char) ) 
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
	public function placement($str = '', $delimiter = '?', $array = array())
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return Errors::set('Error', 'stringParameter', '1.(str)');
		}
		
		if( ! is_array($array) ) 
		{
			return Errors::set('Error', 'arrayParameter', '3.(array)');
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
	
	/******************************************************************************************
	* REPLACE                        	                                         			  *
	*******************************************************************************************
	| Genel Kullanım: Bir alt dizgenin bütün örneklerini yenisiyle değiştirir.	           	  |
	  $case parametresinin false olması durumunda harf duyarlılığı dikkate alınmaz.
	
	  @param  string			$string
	  @param  string, array		$oldChar
	  @param  string, array		$newChar
	  @param  bool				$case defaul false
	  @return string
	|          																				  |
	******************************************************************************************/
	public function replace($string = '', $oldChar = '', $newChar = '', $case = true)
	{
		if( ! is_string($string) ) 
		{
			return Errors::set('Error', 'stringParameter', '1.(string)');
		}
		
		if( $case === true )
		{
			return str_replace($oldChar, $newChar, $string);
		}
		else
		{
			return str_ireplace($oldChar, $newChar, $string);
		}
	}
	
	/******************************************************************************************
	* TO ARRAY                                                                       		  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizgeyi bir ayraca göre bölüp bir dizi haline getirir.	          |
	
	  @param  scalar	$string
	  @param  scalar	$string default secure
	  @return string
	|          																				  |
	******************************************************************************************/
	public function toArray($string = '', $split = ' ')
	{
		if( ! is_string($string) || ! is_string($split) ) 
		{
			return Errors::set('Error', 'scalarParameter', '1.(string) & 2.(split)');
		}
		
		return explode($split, $string);
	}
	
	/******************************************************************************************
	* TO CHAR                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Kodu belirtilen karakteri döndürür.   		                  		  |
	
	  @param  int	$ascii
	  @return string
	|          																				  |
	******************************************************************************************/
	public function toChar($ascii = 32)
	{
		if( ! is_numeric($ascii) ) 
		{
			return Errors::set('Error', 'numericParameter', '1.(ascii)');
		}
		
		return chr($ascii);
	}
	
	/******************************************************************************************
	* TO ASCII                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Belitlen karakterin ascii kodunu döndürür.   		                  	  |
	
	  @param  string	$string
	  @return string
	|          																				  |
	******************************************************************************************/
	public function toAscii($string = '')
	{
		if( ! is_string($string) ) 
		{
			return Errors::set('Error', 'stringParameter', '1.(string)');
		}
		
		return ord($string);
	}
	
	/******************************************************************************************
	* ADD SLASHES                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: Özel karakterlerin önüne tersbölü yerleştirir.	                  	  |
	
	  @param  string	$string
	  @param  string	$addDifferentChars
	  @return string
	|          																				  |
	******************************************************************************************/
	public function addSlashes($string = '', $addDifferentChars = '')
	{
		if( ! is_string($string) || ! is_string($addDifferentChars) ) 
		{
			return Errors::set('Error', 'stringParameter', '1.(string) & 2.(addDifferentChars)');
		}
		
		$return = addslashes($string);
		
		if( ! empty($addDifferentChars) )
		{
			$return = addcslashes($return, $addDifferentChars);
		}
		
		return $return;
	}
	
	/******************************************************************************************
	* ADD SLASHES                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: Özel karakterlerin önüne tersbölü yerleştirir.	                  	  |
	
	  @param  string	$string
	  @return string
	|          																				  |
	******************************************************************************************/
	public function removeSlashes($string = '')
	{
		if( ! is_string($string) ) 
		{
			return Errors::set('Error', 'stringParameter', '1.(string)');
		}
		
		return stripslashes(stripcslashes($string));
	}
	
	/******************************************************************************************
	* LENGTH                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadenin karakter sayısını döndürür	.	                  	  |
	
	  @param  scalar	$string
	  @return string
	|          																				  |
	******************************************************************************************/
	public function length($string = '', $encoding = 'utf-8')
	{
		if( ! is_scalar($string) ) 
		{
			return Errors::set('Error', 'scalarParameter', '1.(string)');
		}
		
		return mb_strlen($string, $encoding);
	}
	
	/******************************************************************************************
	* ENCODE                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Tek yönlü dizge şifrelemesi yapar.	        		 	          	  |
	
	  @param  scalar	$string
	  @param  scalar	$string default secure
	  @return string
	|          																				  |
	******************************************************************************************/
	public function encode($string = '', $salt = 'secure')
	{
		if( ! is_scalar($string) || ! is_scalar($salt) ) 
		{
			return Errors::set('Error', 'scalarParameter', '1.(string) & 2.(salt)');
		}
		
		return crypt($string, $salt);
	}
	
	/******************************************************************************************
	* REPATE                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizgeyi yineler.					        		 	          	  |
	
	  @param  scalar	$string
	  @param  scalar	$string default secure
	  @return string
	|          																				  |
	******************************************************************************************/
	public function repeat($string = '', $count = 1)
	{
		if( ! is_scalar($string) ) 
		{
			return Errors::set('Error', 'scalarParameter', '1.(string)');
		}
		
		return str_repeat($string, $count);
	}
	
	/******************************************************************************************
	* TRANSLATION TABLE                                                           			  *
	*******************************************************************************************
	| Genel Kullanım: htmlentities() tarafından kullanılan dönüşüm tablosunu döndürür.	      |
	
	  @param  numeric	$table  default specialchars -> entities, specialchars
	  @param  numeric	$string default compat       -> compat, quotes, nonquotes
	  @return array
	|          																				  |
	******************************************************************************************/
	public function translationTable($table = HTML_SPECIALCHARS, $quote = ENT_COMPAT)
	{
		if( ! is_scalar($table) || ! is_scalar($quote) ) 
		{
			return Errors::set('Error', 'scalarParameter', '1.(table) & 2.(quote)');
		}
		
		return get_html_translation_table(Convert::toConstant($table, 'HTML_'), Convert::toConstant($quote, 'ENT_'));
	}
}