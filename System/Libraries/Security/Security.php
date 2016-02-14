<?php 
class __USE_STATIC_ACCESS__Security implements SecurityInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Config Değişkeni
	 *  
	 * Güvenlik ayar bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $config;
	
	public function __construct()
	{
		$this->config = Config::get('Security');	
	}
	
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
	* NC ENCODE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Kötü içerikli karakterlerin temizlemesi için                            |
	| kullanılır.												                              |
	|															                              |
	| Parametreler: 3 adet parametre alır.                                                    |
	| 1. string var @string => Temizleme yapılacak metin.                                     |
	| 2. string/array var @badword => Kötü içerikli kelimeler.                                |
	| 3. string/array var @changechar => Değiştirilecek kelilemeler                           |
	|          																				  |
	| 2. ve 3. Parametreler kullanılmaz ise varsayılan olarak Config/Security.php dosyasında  |
	| yer alan nc_encode => change chars karakterleri ayarlı olacaktır. 					  |
	******************************************************************************************/
	public function ncEncode($string = '', $badWords = '', $changeChar = '[badchars]')
	{
		if( ! is_string($string)) 
		{
			return Error::set('Error', 'stringParameter', 'string');
		}
	
		// 2. Parametre boş ise varsayılan olarak Config/Security.php dosya ayarlarını kullan.	
		if( empty($badWords) )
		{
			$secnc      = $this->config['ncEncode'];
			$badWords   = $secnc['bad_chars'];
			$changeChar = $secnc['change_bad_chars'];
		}
		
		if( ! is_array($badWords) ) 
		{
			return $string = Regex::replace($badWords, $changeChar, $string, 'xi');
		}
		
		$ch = '';
		$i  = 0;	
		
		foreach( $badWords as $value )
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
	* INJECTION ENCODE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: SQL sorgularında tehdit edici karakterlerin izole edilmesi için         |
	| kullanılır. Hangi karakterlerin izole edileceği Config/Security.php dosyasında yer alan.|									         
	| Injection_bad_chars parametresinde mevcuttur.											  |				                           
	| Parametreler: 3 adet parametre alır. 													  |
	|																						  |                                                   
	| 1. string var @string => Temizleme yapılacak metin.                                     |
	******************************************************************************************/	
	public function injectionEncode($string = '')
	{
		if( ! is_string($string)) 
		{
			return Error::set('Error', 'stringParameter', 'string');
		}
		
		$secBadChars = $this->config['injectionBadChars'];
		
		if( ! empty($secBadChars)) 
		{
			foreach($secBadChars as $badChar => $changeChar)
			{
				if(is_numeric($badChar))
				{
					$badChar = $changeChar;
					$changeChar = '';
				}
				
				$badChar = trim($badChar, '/');
				
				$string = preg_replace('/'.$badChar.'/xi', $changeChar, $string);
			}
		}
		
		return addslashes(trim($string));
	}
	
	
	/******************************************************************************************
	* INJECTION DECODE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: SQL sorgularında tehdit edici karakterlerin izole edilen karakterlerin  |
	| kullanılır. Ancak sadece izole edilen tırnak işareleri tekrar eski haline getirilir.    |
	|																						  |	
	| 1. string var @string => Temizleme yapılacak metin. 									  |								       
	******************************************************************************************/	
	public function injectionDecode($string = '')
	{
		if( ! is_string($string))
		{ 
			return Error::set('Error', 'stringParameter', 'string');
		}
		
		return stripslashes(trim($string));
	}
	
	
	/******************************************************************************************
	* XSS ENCODE                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Script kodların kullanımında tehdit edici karakterlerin izole edilmesini|
	| sağlamak için kullanılır. Dönüştürülecek karakterlerin listesi için Cofig/Security.php  |	
	|																						  |
	| 1. string var @string => Temizleme yapılacak metin.           					      |
	******************************************************************************************/	
	public function xssEncode($string = '')
	{
		if( ! is_string($string)) 
		{
			return Error::set('Error', 'stringParameter', 'string');
		}
		
		$secBadChars = $this->config['scriptBadChars'];
		
		if( ! empty($secBadChars)) 
		{
			foreach($secBadChars as $badChar => $changeChar)
			{
				if(is_numeric($badChar))
				{
					$badChar = $changeChar;
					$changeChar = '';
				}
				
				$badChar = trim($badChar, '/');
				
				$string = preg_replace('/'.$badChar.'/xi', $changeChar, $string);
			}
		}
		
		return $string;
	}


	/******************************************************************************************
	* HTML EMCODE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: HTML özel karakterlerinin ( < , > )izole edilmesini                     |
	| sağlamak için kullanılır. 															  |	
	|																						  |
	| 1. string var @string => Temizleme yapılacak metin.           					      |
	| 2. string var @type => Tırnak işaretleri.           					                  |
	******************************************************************************************/	
	public function htmlEncode($string = '', $type = 'quotes', $encoding = 'utf-8')
	{
		if( ! is_string($string)) 
		{
			return Error::set('Error', 'stringParameter', 'string');
		}
		
		if( ! is_string($type) ) 
		{	
			$type = 'quotes';
		}
		
		if( $type === 'quotes' ) 
		{
			$tp = ENT_QUOTES; 
		}
		elseif( $type === 'nonquotes' )
		{
			$tp = ENT_NOQUOTES; 
		}
		else 
		{
			$tp = ENT_COMPAT;
		}
		
		return htmlspecialchars(trim($string), $tp, $encoding);
	}
	
	
	/******************************************************************************************
	* HTML DECODE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: İzole edilen HTML özel karakterlerinin ( < , > ) gerçek hallerine       |
	| dönmesini sağlamak için kullanılır. 												      |	
	|																						  |
	| 1. string var @string => Temizleme yapılacak metin.           					      |
	| 2. string var @type => Tırnak işaretleri.           					                  |
	******************************************************************************************/	
	public function htmlDecode($string = '', $type = 'quotes')
	{
		if( ! is_string($string) )
		{
			return Error::set('Error', 'stringParameter', 'string');
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'quotes';
		}
		
		if( $type === 'quotes' )
		{ 
			$tp = ENT_QUOTES; 
		}
		elseif( $type === 'compat' )
		{	
			$tp = ENT_COMPAT; 
		}
		else 
		{
			$tp = ENT_NOQUOTES;
		}
		
		return htmlspecialchars_decode(trim($string), $tp);
	}
	
	// Function: phpTagEncode()
	// İşlev: Php taglarını numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function phpTagEncode($str = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return Error::set('Error', 'stringParameter', 'str');
		}
		
		$phpTagChars = array
		(
			'<?' => '&#60;&#63;',
			'?>' => '&#63;&#62;'
		);
		
		return str_replace(array_keys($phpTagChars), array_values($phpTagChars), $str);
	}
	
	// Function: phpTagDecode()
	// İşlev: Php taglarını numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function phpTagDecode($str = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return Error::set('Error', 'stringParameter', 'str');
		}
		
		$phpTagChars = array
		(
			'<?' => '&#60;&#63;',
			'?>' => '&#63;&#62;'
		);
		
		return str_replace(array_values($phpTagChars), array_keys($phpTagChars), $str);
	}
	
	// Function: nailEncode()
	// İşlev: Tırnak işaretlerini numerik koda dönüştürmek çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function nailEncode($str = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return Error::set('Error', 'stringParameter', 'str');
		}
		
		$nailChars = array
		(
			"'" => "&#39;",
			'"' => "&#34;"
		);
		
		$str = str_replace(array_keys($nailChars), array_values($nailChars), $str);
		
		return $str;
	}
	
	// Function: nailDecode()
	// İşlev: Tırnak işaretlerini numerik koda dönüştürmek çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function nailDecode($str = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return Error::set('Error', 'stringParameter', 'str');
		}
		
		$nailChars = array
		(
			"'" => "&#39;",
			'"' => "&#34;"
		);
		
		$str = str_replace(array_values($nailChars), array_keys($nailChars), $str);
		
		return $str;
	}
	
	// Function: foreignCharEncode()
	// İşlev: Farklı dillerdeki yabancı karakterleri numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function foreignCharEncode($str = '')
	{	
		if( ! is_string($str) || empty($str) ) 
		{
			return Error::set('Error', 'stringParameter', 'str');
		}
		
		$chars = $this->config['numericalCodes'];
		
		return str_replace(array_keys($chars), array_values($chars), $str);
	}	
	
	// Function: foreignCharDecode()
	// İşlev: Farklı dillerdeki yabancı karakterleri numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function foreignCharDecode($str = '')
	{	
		if( ! is_string($str) || empty($str) ) 
		{
			return Error::set('Error', 'stringParameter', 'str');
		}
		
		$chars = $this->config['numericalCodes'];
		
		return str_replace(array_values($chars), array_keys($chars), $str);
	}	
	
	// Function: escapeStringEncode()
	// İşlev: Tırnak işaretlerinin önüne \ işareti getirilir.
	// Parametreler
	// @str = Dönüştürülen data.
	// Dönen Değer: Dönüştürülmüş bilgi.
	public function escapeStringEncode($data = '')
	{
		if( ! is_string($data) ) 
		{
			return Error::set('Error', 'stringParameter', 'data');
		}	
		
		return addslashes($data);
	}
	
	// Function: escapeStringDecode()
	// İşlev: Önüne \ işareti getirilen tırnakları bu sembolden temizler.
	// Parametreler
	// @str = Dönüştürülen data.
	// Dönen Değer: Dönüştürülmüş bilgi.
	public function escapeStringDecode($data = '')
	{
		if( ! is_string($data) ) 
		{
			return Error::set('Error', 'stringParameter', 'data');
		}	
		
		return stripslashes($data);
	}
}