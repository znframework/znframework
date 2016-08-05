<?php
namespace ZN\Helpers;

class InternalConvert extends \CallController implements ConvertInterface
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
	// Anchor
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $data
	// @param string $type: short, long
	// @param array  $attributes
	//
	//----------------------------------------------------------------------------------------------------
	public function anchor(String $data, String $type = NULL, Array $attributes = NULL)
	{
		nullCoalesce($type, 'short');

		return preg_replace
		(
			'/(((https?|ftp)\:\/\/)(\w+\.)*(\w+)\.\w+\/*\S*)/xi', 
			'<a href="$1"'.\Html::attributes((array) $attributes).'>'.( $type === 'short' ? '$5' : '$1').'</a>', 
			$data
		);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Char
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $string
	// @param string $type      : char, dec, hex, html
	// @param string $changeType: char, dec, hex, html
	//
	//----------------------------------------------------------------------------------------------------
	public function char(String $string, String $type = NULL, String $changeType = NULL)
	{
		nullCoalesce($type, 'char');
		nullCoalesce($changeType, 'html');

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

	//----------------------------------------------------------------------------------------------------
	// Accent
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	//
	//----------------------------------------------------------------------------------------------------
	public function accent(String $str) 
	{	
		$accent = \Config::get('ForeignChars', 'accentChars');
		
		$accent = \Arrays::multikey($accent);
		
		return str_replace(array_keys($accent), array_values($accent), $str); 
	} 

	//----------------------------------------------------------------------------------------------------
	// Url Word
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $splitWord
	//
	//----------------------------------------------------------------------------------------------------
	public function urlWord(String $str, String $splitWord = NULL)
	{
		nullCoalesce($splitWord, '-');	
		
		$badChars = \Config::get('Security', 'urlBadChars');
		
		$str = $this->accent($str);
		$str = str_replace($badChars, '', $str);
		$str = preg_replace("/\s+/", ' ', $str);
		$str = str_replace("&nbsp;", '', $str);
		$str = str_replace(' ', $splitWord, trim(strtolower($str)));
		
		return $str;
	}

	//----------------------------------------------------------------------------------------------------
	// String Case
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $type: lower, upper, title
	// @param string $encoding
	//
	//----------------------------------------------------------------------------------------------------
	public function stringCase(String $str, String $type = NULL, String $encoding = NULL)
	{
		nullCoalesce($type, 'lower');
		nullCoalesce($encoding, 'utf-8');

		return mb_convert_case($str, $this->toConstant($type, 'MB_CASE_'), $encoding);	
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Array Case
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array  $array
	// @param string $type  : lower, upper, title
	// @param string $keyval: key, val, value, all
	//
	//----------------------------------------------------------------------------------------------------
	public function arrayCase(Array $array, String $type = NULL, String $keyval = NULL)
	{
		nullCoalesce($type, 'lower');
		nullCoalesce($keyval, 'all');

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
	
	//----------------------------------------------------------------------------------------------------
	// Charset
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param string $fromCharset
	// @param string $toCharset
	//
	//----------------------------------------------------------------------------------------------------
	public function charset(String $str, String $fromCharset, String $toCharset = NULL)
	{
		nullCoalesce($toCharset, 'utf-8');

		return mb_convert_encoding($str, $fromCharset, $toCharset);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// High Light
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $str
	// @param array $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function highLight(String $str, Array $settings = NULL)
	{
		nullCoalesce($settings, []);

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
	
	//----------------------------------------------------------------------------------------------------
	// To Int
	//----------------------------------------------------------------------------------------------------
	// 
	// @param var $var
	//
	//----------------------------------------------------------------------------------------------------
	public function toInt($var)
	{
		return (int) $var;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// To Integer
	//----------------------------------------------------------------------------------------------------
	// 
	// @param var $var
	//
	//----------------------------------------------------------------------------------------------------
	public function toInteger($var)
	{
		return (int) $var;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// To Bool
	//----------------------------------------------------------------------------------------------------
	// 
	// @param var $var
	//
	//----------------------------------------------------------------------------------------------------
	public function toBool($var)
	{
		return (bool) $var;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// To Boolean
	//----------------------------------------------------------------------------------------------------
	// 
	// @param var $var
	//
	//----------------------------------------------------------------------------------------------------
	public function toBoolean($var)
	{
		return (bool) $var;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// To String
	//----------------------------------------------------------------------------------------------------
	// 
	// @param var $var
	//
	//----------------------------------------------------------------------------------------------------
	public function toString($var)
	{
		if( is_array($var) || is_object($var) ) 
		{
			return $var;
		}
		
		return (string) $var;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// To Float
	//----------------------------------------------------------------------------------------------------
	// 
	// @param var $var
	//
	//----------------------------------------------------------------------------------------------------
	public function toFloat($var)
	{
		return (float) $var;	
	}	
	
	//----------------------------------------------------------------------------------------------------
	// To Real
	//----------------------------------------------------------------------------------------------------
	// 
	// @param var $var
	//
	//----------------------------------------------------------------------------------------------------
	public function toReal($var)
	{
		return (real) $var;	
	}	
	
	//----------------------------------------------------------------------------------------------------
	// To Double
	//----------------------------------------------------------------------------------------------------
	// 
	// @param var $var
	//
	//----------------------------------------------------------------------------------------------------
	public function toDouble($var)
	{
		return (double) $var;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// To Object
	//----------------------------------------------------------------------------------------------------
	// 
	// @param var $var
	//
	//----------------------------------------------------------------------------------------------------
	public function toObject($var)
	{
		return (object) $var;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// To Array
	//----------------------------------------------------------------------------------------------------
	// 
	// @param var $var
	//
	//----------------------------------------------------------------------------------------------------
	public function toArray($var)
	{
		return (array) $var;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// To Unset
	//----------------------------------------------------------------------------------------------------
	// 
	// @param var $var
	//
	//----------------------------------------------------------------------------------------------------
	public function toUnset($var)
	{
		return (unset) $var;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// To Constant
	//----------------------------------------------------------------------------------------------------
	// 
	// @param var    $var
	// @param string $prefix
	// @param string $suffix
	//
	//----------------------------------------------------------------------------------------------------
	public function toConstant($var, String $prefix = NULL, String $suffix = NULL)
	{
		if( ! is_scalar($var) )
		{
			return \Exceptions::throws('Error', 'valueParameter', '1.(var)');	
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
	
	//----------------------------------------------------------------------------------------------------
	// To Unset
	//----------------------------------------------------------------------------------------------------
	// 
	// @param var    $var
	// @param string $type
	//
	//----------------------------------------------------------------------------------------------------
	public function varType($var, String $type)
	{
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