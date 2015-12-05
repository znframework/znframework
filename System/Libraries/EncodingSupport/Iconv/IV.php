<?php 
class __USE_STATIC_ACCESS__IV implements IVInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
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
	* CONVERT                     	                                                          *
	*******************************************************************************************
	| Genel Kullanım: Dizgenin karakter kodlamasını dönüştürür.	  							  | 
		
	  @param  string  $string
	  @param  string  $fromEncoding
	  @param  string  $toEncoding
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function convert($string = '', $fromEncoding = '', $toEncoding = '')
	{	
		if( ! is_string($string) )
		{
			return Error::set('Error', 'stringParameter', '1.(string)');	
		}
		
		$toEncodingFirst = Arrays::getFirst(explode('//', $toEncoding));
		
		if( ! isCharset($fromEncoding) || ! isCharset($toEncodingFirst) )
		{
			return Error::set('Error', 'charsetParameter', '2.(fromEncoding) & 3.(toEncoding)');	
		}
		
		return iconv($fromEncoding, $toEncoding, $string);
	}
	
	/******************************************************************************************
	* ENCODING                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Iconv için kullanılabilir kodlama setlerinin listesini döndürür.        | 
		
	  @param  void
	  @return array
	|														                                  |
	******************************************************************************************/
	public function encodings()
	{
		return iconv_get_encoding();
	}
	
	/******************************************************************************************
	* GET ENCODING                                                                            *
	*******************************************************************************************
	| Genel Kullanım: iconv eklentisinin dahili yapılandırma değişkenlerini döndürür.         | 
		
	  @param  string $type -> input, output, internal
	  @return string
	|														                                  |
	******************************************************************************************/
	public function getEncoding($type = 'input')
	{
		if( ! is_string($type) || empty($type) )
		{
			return Error::set('Error', 'stringParameter', '1.(type)');	
		}
		
		return iconv_get_encoding($type.'_encoding');
	}
	
	/******************************************************************************************
	* SET ENCODING                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Karakter kodlaması dönüşümü için geçerli karakter kümesini tanımlar.    | 
		
	  @param  string $type    -> input, output, internal
	  @param  string $charset -> geçerli karakter setlerinden herhangi biri
	  @return bool
	|														                                  |
	******************************************************************************************/
	public function setEncoding($type = '', $charset = '')
	{
		if( ! is_string($type) || empty($type) )
		{
			return Error::set('Error', 'stringParameter', '1.(type)');	
		}
		
		if( ! isCharset($charset) )
		{
			return Error::set('Error', 'charsetParameter', '2.(charset)');
		}
		
		return iconv_set_encoding($type.'_encoding', $charset);
	}
	
	/******************************************************************************************
	* MIME DECODE     		                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir defada birden fazla MIME başlık alanını çözümler.   				  | 
		
	  @param  string $encodedHeaders
	  @param  int	 $mode 0
	  @param  string $charset ini_get("iconv.internal_encoding")
	  @return array  
	|														                                  |
	******************************************************************************************/
	public function mimesDecode($encodedHeaders = '', $mode = 0, $charset = NULL)
	{
		if( ! is_string($encodedHeaders) )
		{
			return Error::set('Error', 'stringParameter', '1.(encodedHeaders)');	
		}
		
		if( ! is_numeric($mode) )
		{
			return Error::set('Error', 'numericParameter', '2.(mode)');
		}
		
		if( $charset === NULL )
		{
			$charset = ini_get("iconv.internal_encoding");
		}
		
		return iconv_mime_decode_headers($encodedHeaders, $mode, $charset);
	}
	
	/******************************************************************************************
	* MIME DECODE                	                                                          *
	*******************************************************************************************
	| Genel Kullanım: Bir MIME başlık alanının kodunu çözer.   								  | 
		
	  @param  string $encodedHeaders
	  @param  int	 $mode 0
	  @param  string $charset ini_get("iconv.internal_encoding")
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function mimeDecode($encodedHeader = '', $mode = 0, $charset = NULL)
	{
		if( ! is_string($encodedHeader) )
		{
			return Error::set('Error', 'stringParameter', '1.(encodedHeader)');	
		}
		
		if( ! is_numeric($mode) )
		{
			return Error::set('Error', 'numericParameter', '2.(mode)');
		}
		
		if( $charset === NULL )
		{
			$charset = ini_get("iconv.internal_encoding");
		}
		
		return iconv_mime_decode($encodedHeader, $mode, $charset);
	}
	
	/******************************************************************************************
	* MIME ENCODE                	                                                          *
	*******************************************************************************************
	| Genel Kullanım: Bir MIME başlık alanı düzenler.		   								  | 
		
	  @param  string $fieldName
	  @param  string $fieldValue
	  @param  array  $preferences
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function mimeEncode($fieldName = '', $fieldValue = '', $preferences = array())
	{
		if( ! is_string($fieldName) || ! is_string($fieldValue) )
		{
			return Error::set('Error', 'stringParameter', '1.(fieldName) & 2.(fieldValue)');	
		}
	
		return iconv_mime_encode($fieldName, $fieldValue, $preferences);
	}
}