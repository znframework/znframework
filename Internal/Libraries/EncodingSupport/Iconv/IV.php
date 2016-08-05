<?php 
namespace ZN\EncodingSupport;

class InternalIV extends \CallController implements IVInterface
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
	// Inputs
	//----------------------------------------------------------------------------------------------------
	// 
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	protected $inputs = ['input', 'output', 'internal'];
	
	//----------------------------------------------------------------------------------------------------
	// Convert
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $string
	// @param string $fromEncoding
	// @param string $toEncoding
	//
	//----------------------------------------------------------------------------------------------------
	public function convert(String $string, String $fromEncoding, String $toEncoding)
	{	
		$toEncodingFirst = \Arrays::getFirst(explode('//', $toEncoding));
		
		if( ! isCharset($fromEncoding) || ! isCharset($toEncodingFirst) )
		{
			return \Exceptions::throws('Error', 'charsetParameter', '2.(fromEncoding) & 3.(toEncoding)');	
		}
		
		return iconv($fromEncoding, $toEncoding, $string);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Encodings
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function encodings()
	{
		return iconv_get_encoding();
	}
	
	//----------------------------------------------------------------------------------------------------
	// Get Encoding
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $type
	//
	//----------------------------------------------------------------------------------------------------
	public function getEncoding(String $type = NULL)
	{
		nullCoalesce($type, 'input');

		if( ! in_array($type, $this->inputs) )
		{
			return \Exceptions::throws('Error', 'invalidInput', $type);	
		}
		
		return iconv_get_encoding($type.'_encoding');
	}
	
	//----------------------------------------------------------------------------------------------------
	// Set Encoding
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $type
	// @param string $charset
	//
	//----------------------------------------------------------------------------------------------------
	public function setEncoding(String $type = NULL, String $charset = NULL)
	{
		nullCoalesce($type, 'input');
		nullCoalesce($charset, 'utf-8');

		if( ! is_array($type, $this->inputs) )
		{
			return \Exceptions::throws('Error', 'invalidInput', $type);	
		}
		
		if( ! isCharset($charset) )
		{
			return \Exceptions::throws('Error', 'charsetParameter', '2.(charset)');
		}
		
		return iconv_set_encoding($type.'_encoding', $charset);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Mimes Decode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $encodedHeaders
	// @param int    $mode
	// @param string $charset
	//
	//----------------------------------------------------------------------------------------------------
	public function mimesDecode(String $encodedHeaders, $mode = 0, $charset = NULL)
	{
		if( $charset === NULL )
		{
			$charset = ini_get("iconv.internal_encoding");
		}
		
		return iconv_mime_decode_headers($encodedHeaders, $mode, $charset);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Mime Decode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $encodedHeader
	// @param int    $mode
	// @param string $charset
	//
	//----------------------------------------------------------------------------------------------------
	public function mimeDecode(String $encodedHeader, $mode = 0, $charset = NULL)
	{
		if( $charset === NULL )
		{
			$charset = ini_get("iconv.internal_encoding");
		}
		
		return iconv_mime_decode($encodedHeader, $mode, $charset);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Mime Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $fieldName
	// @param string $fieldValue
	// @param array  $preferences
	//
	//----------------------------------------------------------------------------------------------------
	public function mimeEncode(String $fieldName, String $fieldValue, Array $preferences = NULL)
	{
		return iconv_mime_encode($fieldName, $fieldValue, (array) $preferences);
	}
}