<?php
namespace ZN\VariableTypes;

class InternalStrings implements StringsInterface
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
	// mtrim
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function mtrim($str = '')
	{
		if( ! is_scalar($str) ) 
		{
			return \Errors::set('Error', 'scalarParameter', '1.(str)');
		}
		
		$str = preg_replace
		(
			['/\s+/', '/&nbsp;/', "/\n/", "/\r/", "/\t/"], 
			['', '', '', '', ''], 
			$str
		);
		
		return $str;
	}	

	//----------------------------------------------------------------------------------------------------
	// Trim Slashes
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function trimSlashes($str = '')
	{
		if( ! is_string($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(str)');
		}
		
		$str = trim($str, "/");
		
		return $str;
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Casing
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $type lower, upper, title
	// @param string $encoding
	//
	//----------------------------------------------------------------------------------------------------
	public function casing($str = '', $type = 'lower', $encoding = "utf-8")
	{
		return \Convert::stringCase($str, $type, $encoding);
	}

	//----------------------------------------------------------------------------------------------------
	// Upper Case
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $encoding
	//
	//----------------------------------------------------------------------------------------------------
	public function upperCase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str) || ! isCharset($encoding) ) 
		{
			\Errors::set('Error', 'stringParameter', '1.(str)');
			\Errors::set('Error', 'charsetParameter', '2.(encoding)');
			
			return false;
		}
		
		$str = mb_convert_case($str, MB_CASE_UPPER, $encoding);
		
		return $str;
	}	

	//----------------------------------------------------------------------------------------------------
	// Lower Case
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $encoding
	//
	//----------------------------------------------------------------------------------------------------
	public function lowerCase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str) || ! isCharset($encoding) ) 
		{
			\Errors::set('Error', 'stringParameter', '1.(str)');
			\Errors::set('Error', 'charsetParameter', '2.(encoding)');
			
			return false;
		}
		
		$str = mb_convert_case($str, MB_CASE_LOWER, $encoding);
		
		return $str;
	}	

	//----------------------------------------------------------------------------------------------------
	// Title Case
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $encoding
	//
	//----------------------------------------------------------------------------------------------------
	public function titleCase($str = '', $encoding = 'utf-8')
	{
		if( ! is_string($str) || ! isCharset($encoding) ) 
		{
			\Errors::set('Error', 'stringParameter', '1.(str)');
			\Errors::set('Error', 'charsetParameter', '2.(encoding)');
			
			return false;
		}
		
		$str = mb_convert_case($str, MB_CASE_TITLE, $encoding);
		
		return $str;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Camel Case
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function camelCase($str = '')
	{
		$string = $this->titleCase($str);
		
		$string[0] = $this->lowerCase($string);
		
		return $this->mtrim($string);
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Pascal Case
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function pascalCase($str = '')
	{
		$string = $this->titleCase($str);
		
		return $this->mtrim($string);
	}

	//----------------------------------------------------------------------------------------------------
	// Section
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function section($str = '', $starting = 0, $count = NULL, $encoding = "utf-8")
	{
		if( ! is_string($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(str)');
		}
		
		return mb_substr($str, $starting, $count, $encoding);
	}	

	//----------------------------------------------------------------------------------------------------
	// Search
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $needle
	// @param string $type
	// @param string $case
	//
	//----------------------------------------------------------------------------------------------------
	public function search($str = '', $needle = '', $type = "str", $case = true)
	{
		if( ! is_string($str) || ! is_string($needle) || ! is_string($type) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(str) & 2.(neddle) & 3.($type)');
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

	//----------------------------------------------------------------------------------------------------
	// Reshuffle
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $shuffle
	// @param string $reshuffle
	//
	//----------------------------------------------------------------------------------------------------
	public function reshuffle($str = '', $shuffle = '', $reshuffle = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(str)');
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

	//----------------------------------------------------------------------------------------------------
	// Recurrent Count
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $char
	//
	//----------------------------------------------------------------------------------------------------
	public function recurrentCount($str = '', $char = '')
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(str)');
		}
		
		if( ! is_scalar($char) ) 
		{
			return $str;
		}
		
		return count(explode($char, $str)) - 1;
	}	

	//----------------------------------------------------------------------------------------------------
	// Placement
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $delimiter
	// @param array  $array
	//
	//----------------------------------------------------------------------------------------------------
	public function placement($str = '', $delimiter = '?', $array = [])
	{
		if( ! is_string($str) || empty($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(str)');
		}
		
		if( ! is_array($array) ) 
		{
			return \Errors::set('Error', 'arrayParameter', '3.(array)');
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
	
	//----------------------------------------------------------------------------------------------------
	// Replace
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $delimiter
	// @param array  $array
	//
	//----------------------------------------------------------------------------------------------------
	public function replace($string = '', $oldChar = '', $newChar = '', $case = true)
	{
		if( ! is_string($string) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(string)');
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
	
	//----------------------------------------------------------------------------------------------------
	// To Array
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $string
	// @param string $split
	//
	//----------------------------------------------------------------------------------------------------
	public function toArray($string = '', $split = ' ')
	{
		if( ! is_string($string) || ! is_string($split) ) 
		{
			return \Errors::set('Error', 'scalarParameter', '1.(string) & 2.(split)');
		}
		
		return explode($split, $string);
	}
	
	//----------------------------------------------------------------------------------------------------
	// To Char
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $ascii
	//
	//----------------------------------------------------------------------------------------------------
	public function toChar($ascii = 32)
	{
		if( ! is_numeric($ascii) ) 
		{
			return \Errors::set('Error', 'numericParameter', '1.(ascii)');
		}
		
		return chr($ascii);
	}
	
	//----------------------------------------------------------------------------------------------------
	// To Ascii
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function toAscii($string = '')
	{
		if( ! is_string($string) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(string)');
		}
		
		return ord($string);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Add Slashes
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $addDifferentChars
	//
	//----------------------------------------------------------------------------------------------------
	public function addSlashes($string = '', $addDifferentChars = '')
	{
		if( ! is_string($string) || ! is_string($addDifferentChars) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(string) & 2.(addDifferentChars)');
		}
		
		$return = addslashes($string);
		
		if( ! empty($addDifferentChars) )
		{
			$return = addcslashes($return, $addDifferentChars);
		}
		
		return $return;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Remove Slashes
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function removeSlashes($string = '')
	{
		if( ! is_string($string) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(string)');
		}
		
		return stripslashes(stripcslashes($string));
	}
	
	//----------------------------------------------------------------------------------------------------
	// Length
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $encoding
	//
	//----------------------------------------------------------------------------------------------------
	public function length($string = '', $encoding = 'utf-8')
	{
		if( ! is_scalar($string) ) 
		{
			return \Errors::set('Error', 'scalarParameter', '1.(string)');
		}
		
		return mb_strlen($string, $encoding);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $salt
	//
	//----------------------------------------------------------------------------------------------------
	public function encode($string = '', $salt = 'secure')
	{
		if( ! is_scalar($string) || ! is_scalar($salt) ) 
		{
			return \Errors::set('Error', 'scalarParameter', '1.(string) & 2.(salt)');
		}
		
		return crypt($string, $salt);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Repeat
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param numeric $count
	//
	//----------------------------------------------------------------------------------------------------
	public function repeat($string = '', $count = 1)
	{
		if( ! is_scalar($string) ) 
		{
			return \Errors::set('Error', 'scalarParameter', '1.(string)');
		}
		
		return str_repeat($string, $count);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Pad
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param numeric $count
	// @param string  $chars
	// @param string  $type
	//
	//----------------------------------------------------------------------------------------------------
	public function pad($string = '', $count = 1, $chars = ' ', $type = 'right')
	{
		if( ! is_scalar($string) ) 
		{
			return \Errors::set('Error', 'scalarParameter', '1.(string)');
		}
		
		return str_pad($string, $count, $chars, \Convert::toConstant($type, 'STR_PAD_'));
	}
	
	//----------------------------------------------------------------------------------------------------
	// Apportion
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string  $string
	// @param numeric $length
	// @param string  $end
	//
	//----------------------------------------------------------------------------------------------------
	public function apportion($string = '', $length = 76, $end = "\r\n")
	{
		if( ! is_scalar($string) ) 
		{
			return \Errors::set('Error', 'scalarParameter', '1.(string)');
		}
		
		$arrayChunk = array_chunk(preg_split("//u", $string, -1, PREG_SPLIT_NO_EMPTY), $length);
	
		$string = "";
		
		foreach( $arrayChunk as $chunk ) 
		{
			$string .= implode("", $chunk) . $end;
		}
		
		return $string;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Divide
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string  $string
	// @param string  $seperator
	// @param numeric $index
	//
	//----------------------------------------------------------------------------------------------------
	public function divide($str = '', $separator = "|", $index = 0)
	{
		return divide($str, $separator, $index);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Translation Table
	//----------------------------------------------------------------------------------------------------
	// 
	// @param numeric $table
	// @param numeric $quote
	//
	//----------------------------------------------------------------------------------------------------
	public function translationTable($table = HTML_SPECIALCHARS, $quote = ENT_COMPAT)
	{
		if( ! is_scalar($table) || ! is_scalar($quote) ) 
		{
			return \Errors::set('Error', 'scalarParameter', '1.(table) & 2.(quote)');
		}
		
		return get_html_translation_table(\Convert::toConstant($table, 'HTML_'), \Convert::toConstant($quote, 'ENT_'));
	}
}