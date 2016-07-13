<?php
namespace ZN\Helpers;

class InternalConvert implements ConvertInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	use \CallUndefinedMethodTrait;
	
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
	use \ErrorControlTrait;
	
	//----------------------------------------------------------------------------------------------------
	// anchor
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $data
	// @param string $type: short, long
	// @param array  $attributes
	//
	//----------------------------------------------------------------------------------------------------
	public function anchor($data = '', $type = 'short', $attributes = [])
	{
		return preg_replace
		(
			'/(((https?|ftp)\:\/\/)(\w+\.)*(\w+)\.\w+\/*\S*)/xi', 
			'<a href="$1"'.\Html::attributes($attributes).'>'.( $type === 'short' ? '$5' : '$1').'</a>', 
			$data
		);
	}
	
	/******************************************************************************************
	* CHAR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Karakterleri bir türden diğer türe dönüştürmek için kullanılır. 		  |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 2. [ string var @type ] => Hangi türden dönüşüm yapılacağı. Varsayılan:char			  |
	| 3. [ string var @change_type ] => Hangi türe dönüşüm yapılacağı. Varsayılan:html		  |
	|   																					  |
	| Dönüştürülebilecek türler => char, html, dex, hex										  |
	|       																				  |
	| Örnek Kullanım:  																	      |
	| echo char('Metin'); // Kaynak Kod Çıktı: &#77;&#101;&#116;&#105;&#110; 		  		  |
	| echo char('Metin', 'char', 'dec'); // Çıktı: 77 101 116 105 110 			  			  |
	| echo char('Metin', 'char', 'hex'); // Çıktı: 4D 65 74 69 6E 				  			  |
	|																						  |
	| Kendi Aralarında Dönüştürme														      |
	| $html = char('Metin');														  		  |
	| $dec = char('Metin', 'char', 'dec');										  			  |
	| $hex = char('Metin', 'char', 'hex');										  			  |
	|																						  |
	| echo char($hex, 'hex', 'char'); // Çıktı: Metin								  		  |
	| echo char($dec, 'dec', 'hex'); // Çıktı: 4D 65 74 69 6E					     	 	  |
	| echo char($html, 'html', 'dec'); // Çıktı: 77 101 116 105 110                 		  |	
	|       																				  |
	******************************************************************************************/
	public function char($string = '', $type = 'char', $changeType = 'html')
	{
		if( ! is_scalar($string) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'string');
		}
		
		$string = $this->accent($string);
		
		if( ! is_string($type) ) 
		{
			$type = 'char';
		}
		
		if( ! is_string($changeType) ) 
		{
			$changeType = 'html';
		}
		
		for( $i = 32; $i <= 255; $i++ )
		{
			$hexRemaining = ( $i % 16 );
			$hexRemaining = str_replace( [10, 11, 12, 13, 14, 15], ['A', 'B', 'C', 'D', 'E', 'F'], $hexRemaining );
			$hex 		  = ( floor( $i / 16) ).$hexRemaining;
			
			if( $hex[0] == '0' ) 
			{
				$hex = $hex[1];	
			}
			
			if( chr($i) !== ' ' )
			{
				$chars['char'][] = chr($i);
				$chars['dec'][]  = $i." ";
				$chars['hex'][]  = $hex." ";
				$chars['html'][] = "&#{$i};";
			}		
		}	
		
		return str_replace( $chars[strtolower($type)], $chars[strtolower($changeType)], $string );
	}

	/******************************************************************************************
	* ACCENT CONVERTER                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Yabancı içerikli karaketerleri standart karakterlere dönüştürür. 		  |
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	|       																				  |
	| Örnek Kullanım:  																	      |
	| echo accent_converter('Åķŝǻň'); // Çıktı: Aksan 										  |
	|       																				  |
	******************************************************************************************/
	public function accent($str = '') 
	{	
		if( ! is_string($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'str');
		}
		
		// Config/ForeignChars.php dosyasından
		// kullanılacak karakter listesini al.
		$accent = \Config::get('ForeignChars', 'accentChars');
		
		$accent = \Arrays::multikey($accent);
		
		return str_replace(array_keys($accent), array_values($accent), $str); 
	} 

	/******************************************************************************************
	* URL WORD CONVERTER                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Yabancı karaketer içerikli metni url yapısına uygun hale dönüştürür 	  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 1. [ string var @splitword ] => Kelimeler arasına konacak işaret. Varsayılan:-		  |
	|       																				  |
	| Örnek Kullanım:  																	      |
	| echo url_word_converter('Zn Kod Çatısına Hoş'); // zn-kod-catisina-hos 				  |
	| echo url_word_converter('Zn Kod Çatısına Hoş', '/'); //  zn/kod/catisina/hos			  |
	|       																				  |
	******************************************************************************************/
	public function urlWord($str = '', $splitWord = '-')
	{
		if( ! is_string($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'str');
		}
	
		if( ! is_string($splitWord) ) 
		{
			$splitWord = "-";
		}	
		
		$badChars = \Config::get('Security', 'urlBadChars');
		
		$str = $this->accent($str);
		$str = str_replace($badChars, '', $str);
		$str = preg_replace("/\s+/", ' ', $str);
		$str = str_replace("&nbsp;", '', $str);
		$str = str_replace(' ', $splitWord, trim(strtolower($str)));
		
		return $str;
	}

	/******************************************************************************************
	* ARRAY CASE -> V2 - TEMMUZ GÜNCELLEMESİ                                                                        *
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
	| echo case_converter('Zn Kod Çatısına Hoş'); // Çıktı: zn kod çatısına hoş				  |
	| echo case_converter('Zn Kod Çatısına Hoş', 'upper'); // Çıktı: ZN KOD ÇATISINA HOŞ	  |
	| echo case_converter('Zn Kod Çatısına Hoş', 'title'); // Çıktı: Zn Kod Çatısına Hoş	  |
	|       																				  |
	******************************************************************************************/
	public function stringCase($str = '', $type = 'lower', $encoding = "utf-8")
	{
		if( ! is_string($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'str');
		}
		
		return mb_convert_case($str, $this->toConstant($type, 'MB_CASE_'), $encoding);	
	}	
	
	/******************************************************************************************
	* ARRAY CASE -> V2 - TEMMUZ GÜNCELLEMESİ                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizi anahtar ve değerlerinde harf dönüşümü yapmak için kullanılır .     |
	
	  @param array  $array
	  @param string $type lower, upper, title
	  @param string $keyval all, key, val/value
	|																						  |
	******************************************************************************************/
	public function arrayCase($array = [], $type = 'lower', $keyval = 'all')
	{
		if( ! is_array($array) || ! is_string($type) || ! is_string($keyval) )
		{
			\Errors::set('Error', 'arrayParameter', 'array');
			\Errors::set('Error', 'stringParameter', 'type');
			\Errors::set('Error', 'stringParameter', 'keyval');
			
			return false;	
		}
		
		if( $type === 'lower' )
		{
			$caseType = 'Strings::lowerCase';	
		}
		elseif( $type === 'upper' )
		{
			$caseType = 'Strings::upperCase';		
		}
		elseif( $type === 'title' )
		{
			$caseType = 'Strings::titleCase';	
		}
		
		$arrayVals = array_values($array);
		$arrayKeys = array_keys($array);
		
		if( $keyval === 'key' )
		{
			$arrayKeys = array_map($caseType, $arrayKeys);
		}
		elseif( $keyval === 'val' || $keyval === 'value' )
		{
			$arrayVals = array_map($caseType, $arrayVals);
		}
		else
		{
			$arrayKeys = array_map($caseType, $arrayKeys);
			$arrayVals = array_map($caseType, $arrayVals);		
		}
		
		$newArray = [];
		
		for($i = 0; $i < count($array); $i++)
		{
			$newArray[$arrayKeys[$i]] = $arrayVals[$i];
		}
		
		return $newArray;
	}
	
	/******************************************************************************************
	* CHARSET CONVERTER                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Küçük büyük harf dönüştürmeleri yapmak için kullanılır.			  	  |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 2. [ string var @from_charset ] => Hangi karakter setinden. Varsayılan:utf-8			  |
	| 3. [ string var @to_charset ] => Hangi karakter setine. Varsayılan:utf-8				  |
	|																						  |
	| Örnek Kullanım:  																	      |
	| echo case_converter('Zn Kod Çatısına Hoş', 'latin5', 'urtf-8');                         |
	|       																				  |
	******************************************************************************************/
	public function charset($str = '', $fromCharset = 'utf-8', $toCharset = 'utf-8')
	{
		if( ! is_string($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'str');
		}
		
		if( ! isCharset($fromCharset) || ! isCharset($toCharset) ) 
		{
			\Errors::set('Error', 'charsetParameter', 'fromCharset');
			\Errors::set('Error', 'charsetParameter', 'toCharset');
			
			return false;
		}
		
		return mb_convert_encoding($str, $fromCharset, $toCharset);	
	}
	
	/******************************************************************************************
	* HIGH LIGHT                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Girilen metinsel kodun yazı biçimini ve renkleri ayarlamak içindir.	  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 2. [ array var @settings ] => Renk ve yazı ayarları.									  |
	|																						  |
	| Örnek Kullanım: highLight('echo 1;');  											  	  |
	|       																				  |
	******************************************************************************************/
	public function highLight($str = '', $settings = [])
	{
		if( ! is_string($str) || ! is_array($settings) )
		{
			\Errors::set('Error', 'stringParameter', 'str');
			\Errors::set('Error', 'arrayParameter', 'settings');
			
			return false;	
		}
		
		$phpFamily 	    = ! empty( $settings['php:family'] ) ? 'font-family:'.$settings['php:family'] : 'font-family:Consolas';
		$phpSize   	    = ! empty( $settings['php:size'] )   ? 'font-size:'.$settings['php:size'] : 'font-size:12px';
		$phpStyle   	= ! empty( $settings['php:style'] )  ? $settings['php:style'] : '';		
		$htmlFamily 	= ! empty( $settings['html:family'] ) ? 'font-family:'.$settings['html:family'] : '';
		$htmlSize   	= ! empty( $settings['html:size'] )   ? 'font-size:'.$settings['html:size'] : '';
		$htmlColor  	= ! empty( $settings['html:color'] )  ? $settings['html:color'] : '';
		$htmlStyle 		= ! empty( $settings['html:style'] )  ? $settings['html:style'] : '';		
		$comment    	= ! empty( $settings['comment:color'] ) ? $settings['comment:color'] : '#969896';
		$commentStyle	= ! empty( $settings['comment:style'] ) ? $settings['comment:style'] : '';
		$default    	= ! empty( $settings['default:color'] ) ? $settings['default:color'] : '#000000';
		$defaultStyle   = ! empty( $settings['default:style'] ) ? $settings['default:style'] : '';
		$keyword    	= ! empty( $settings['keyword:color'] ) ? $settings['keyword:color'] : '#a71d5d';
		$keywordStyle   = ! empty( $settings['keyword:style'] ) ? $settings['keyword:style'] : '';
		$string     	= ! empty( $settings['string:color'] )  ? $settings['string:color']  : '#183691';
		$stringStyle	= ! empty( $settings['string:style'] )  ? $settings['string:style']  : '';	
		$background 	= ! empty( $settings['background'] )   ? $settings['background'] : '';	
		$tags       	= isset( $settings['tags'] )  ? $settings['tags']  : true;
		
		ini_set("highlight.comment", "$comment; $phpFamily; $phpSize; $phpStyle; $commentStyle");
		ini_set("highlight.default", "$default; $phpFamily; $phpSize; $phpStyle; $defaultStyle");
		ini_set("highlight.keyword", "$keyword; $phpFamily; $phpSize; $phpStyle; $keywordStyle ");
		ini_set("highlight.string",  "$string;  $phpFamily; $phpSize; $phpStyle; $stringStyle");	
		ini_set("highlight.html",    "$htmlColor; $htmlFamily; $htmlSize; $htmlStyle");
		
		// ----------------------------------------------------------------------------------------------
		// HIGHLIGHT
		// ----------------------------------------------------------------------------------------------
		$string = highlight_string($str, true);
		// ----------------------------------------------------------------------------------------------
	
		$string = \Security::scriptTagEncode(\Security::phpTagEncode(\Security::htmlDecode($string)));
		
		$tagArray = $tags === true 
		          ? ['<div style="'.$background.'">&#60;&#63;php', '&#63;&#62;</div>']
		          : ['<div style="'.$background.'">', '</div>'];
		
		return str_replace(['&#60;&#63;php', '&#63;&#62;'], $tagArray, $string);
    }
	
	/******************************************************************************************
	* TO INT			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü int türüne çevirmek için kullanılır.			  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toInt($var = NULL)
	{
		return (int)$var;	
	}
	
	/******************************************************************************************
	* TO INTEGER			                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü int türüne çevirmek için kullanılır.			  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toInteger($var = NULL)
	{
		return (integer)$var;	
	}
	
	/******************************************************************************************
	* TO BOOL			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü boolean türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toBool($var = NULL)
	{
		return (bool)$var;	
	}
	
	/******************************************************************************************
	* TO BOOLEAN    	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü boolean türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toBoolean($var = NULL)
	{
		return (boolean)$var;	
	}
	
	/******************************************************************************************
	* TO STRING      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü string türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toString($var = NULL)
	{
		if( is_array($var) || is_object($var) ) 
		{
			return $var;
		}
		
		return (string)$var;	
	}
	
	/******************************************************************************************
	* TO FLOAT      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü float türüne çevirmek için kullanılır.		      |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toFloat($var = NULL)
	{
		return (float)$var;	
	}	
	
	/******************************************************************************************
	* TO REAL        	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü real türüne çevirmek için kullanılır.		      |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toReal($var = NULL)
	{
		return (real)$var;	
	}	
	
	/******************************************************************************************
	* TO DOUBLE      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü double türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toDouble($var = NULL)
	{
		return (double)$var;	
	}
	
	/******************************************************************************************
	* TO OBJECT      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü object türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toObject($var = NULL)
	{
		return (object)$var;	
	}
	
	/******************************************************************************************
	* TO ARRAY      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü array türüne çevirmek için kullanılır.		      |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toArray($var = NULL)
	{
		return (array)$var;	
	}
	
	/******************************************************************************************
	* TO UNSET      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkeni silmek için kullanılır.		  								  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Silinecek değişken.				                         	  	  |
	|       																				  |
	******************************************************************************************/
	public function toUnset($var = NULL)
	{
		return (unset)$var;	
	}
	
	/******************************************************************************************
	* TO CONSTANT      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: String ifadeyi contant türüne çevirmek için kullanılır.				  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Çevrilecek değişken.				                         	  	  |
	|       																				  |
	******************************************************************************************/
	public function toConstant($var = NULL, $prefix = '', $suffix = '')
	{
		if( ! is_scalar($var) )
		{
			return \Errors::set('Error', 'valueParameter', '1.(var)');	
		}
		
		if( ! is_string($prefix) || ! is_string($suffix) )
		{
			return \Errors::set('Error', 'stringParameter', '2.(prefix) & 2.(suffix)');	
		}
			
		if( defined(strtoupper($prefix.$var.$suffix)) )
		{
			return constant(strtoupper($prefix.$var.$suffix));
		}
		elseif( defined($var) )
		{
			return constant($var);
		}
		else
		{
			return $var;	
		}
	}
	
	/******************************************************************************************
	* VAR TYPE			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü değiştirmek için kullanılır.			  	  	  |	
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	| 2. [ string var @type ] => Hangi türe. Varsayılan:int									  |
	|																						  |
	| Örnek Kullanım:  																	      |
	| echo case_converter('Zn Kod Çatısına Hoş', 'latin5', 'urtf-8');                         |
	|       																				  |
	******************************************************************************************/
	public function varType($var = '', $type = 'int')
	{
		if( ! is_string($type) ) 
		{
			return false;
		}
		
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