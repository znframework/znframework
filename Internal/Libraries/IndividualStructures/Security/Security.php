<?php 
namespace ZN\IndividualStructures;

class InternalSecurity extends \Requirements implements SecurityInterface
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
	// Nail Chars
	//----------------------------------------------------------------------------------------------------
	// 
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	protected $nailChars = array
	(
		"'" => "&#39;",
		'"' => "&#34;"
	);
	
	//----------------------------------------------------------------------------------------------------
	// PHP Tag Chars
	//----------------------------------------------------------------------------------------------------
	// 
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	protected $phpTagChars = array
	(
		'<?' => '&#60;&#63;',
		'?>' => '&#63;&#62;'
	);
	
	//----------------------------------------------------------------------------------------------------
	// PHP Tag Chars
	//----------------------------------------------------------------------------------------------------
	// 
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	protected $scriptTagChars = array
	(
		'/\<script(.*?)\>/i'  => '&#60;script$1&#62;',
		'/\<\/script\>/i'     => '&#60;/script&#62;'
	);
	
	//----------------------------------------------------------------------------------------------------
	// PHP Tag Chars
	//----------------------------------------------------------------------------------------------------
	// 
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	protected $scriptTagCharsDecode = array
	(
		'/\&\#60\;script(.*?)\&\#62\;/i' => '<script$1>',
		'/\&\#60\;\/script\&\#62\;/i'	 => '</script>'
	);
	
	//----------------------------------------------------------------------------------------------------
	// Nc Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $string 
	// @param mixed  $badWords
	// @param mixed  $changeChar
	//
	//----------------------------------------------------------------------------------------------------
	public function ncEncode(String $string, $badWords = NULL, $changeChar = '[badchars]')
	{
		// 2. Parametre boş ise varsayılan olarak Config/Security.php dosya ayarlarını kullan.	
		if( empty($badWords) )
		{
			$secnc      = $this->config['ncEncode'];
			$badWords   = $secnc['badChars'];
			$changeChar = $secnc['changeBadChars'];
		}
		
		if( ! is_array($badWords) ) 
		{
			return $string = \Regex::replace($badWords, $changeChar, $string, 'xi');
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
			
			$string = \Regex::replace($value, $ch, $string, 'xi');
		}
	
		return $string;
	}	
		
	//----------------------------------------------------------------------------------------------------
	// Injection Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $string
	//
	//----------------------------------------------------------------------------------------------------
	public function injectionEncode(String $string)
	{
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
	
	//----------------------------------------------------------------------------------------------------
	// Injection Decode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $string
	//
	//----------------------------------------------------------------------------------------------------
	public function injectionDecode(String $string)
	{
		return stripslashes(trim($string));
	}
	
	//----------------------------------------------------------------------------------------------------
	// Xss Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $string
	//
	//----------------------------------------------------------------------------------------------------
	public function xssEncode(String $string)
	{
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


	//----------------------------------------------------------------------------------------------------
	// Html Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $string
	// @param string $type: quotes, nonquotes, compat
	// @param string $encoding
	//
	//----------------------------------------------------------------------------------------------------
	public function htmlEncode(String $string, $type = 'quotes', $encoding = 'utf-8')
	{
		return htmlspecialchars(trim($string), \Convert::toConstant($type, 'ENT_'), $encoding);
	}
	
	
	//----------------------------------------------------------------------------------------------------
	// Html Decode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $string
	// @param string $type: quotes, nonquotes, compat
	//
	//----------------------------------------------------------------------------------------------------
	public function htmlDecode(String $string, $type = 'quotes')
	{
		return htmlspecialchars_decode(trim($string), \Convert::toConstant($type, 'ENT_'));
	}
	
	//----------------------------------------------------------------------------------------------------
	// PHP Tag Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function phpTagEncode(String $str)
	{	
		return str_replace(array_keys($this->phpTagChars), array_values($this->phpTagChars), $str);
	}
	
	//----------------------------------------------------------------------------------------------------
	// PHP Tag Decode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function phpTagDecode(String $str)
	{
		return str_replace(array_values($this->phpTagChars), array_keys($this->phpTagChars), $str);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Script Tag Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function scriptTagEncode(String $str)
	{
		return preg_replace(array_keys($this->scriptTagChars), array_values($this->scriptTagChars), $str);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Script Tag Decode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function scriptTagDecode(String $str)
	{
		return preg_replace(array_keys($this->scriptTagCharsDecode), array_values($this->scriptTagCharsDecode), $str);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Nail Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function nailEncode(String $str)
	{
		$str = str_replace(array_keys($this->nailChars), array_values($this->nailChars), $str);
		
		return $str;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Nail Decode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function nailDecode(String $str)
	{
		$str = str_replace(array_values($this->nailChars), array_keys($this->nailChars), $str);
		
		return $str;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Foreign Char Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function foreignCharEncode(String $str)
	{	
		$chars = $this->config['numericalCodes'];
		
		return str_replace(array_keys($chars), array_values($chars), $str);
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Foreign Char Decode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function foreignCharDecode(String $str)
	{	
		$chars = $this->config['numericalCodes'];
		
		return str_replace(array_values($chars), array_keys($chars), $str);
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Escape String Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $data
	//
	//----------------------------------------------------------------------------------------------------
	public function escapeStringEncode(String $data)
	{
		return addslashes($data);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Escape String Decode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function escapeStringDecode(String $data)
	{
		return stripslashes($data);
	}
}