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
	public function convert(String $string, String $fromEncoding, String $toEncoding)
	{	
		$toEncodingFirst = \Arrays::getFirst(explode('//', $toEncoding));
		
		if( ! isCharset($fromEncoding) || ! isCharset($toEncodingFirst) )
		{
			return \Exceptions::throws('Error', 'charsetParameter', '2.(fromEncoding) & 3.(toEncoding)');	
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
		if( ! in_array($type, $this->inputs) )
		{
			return \Exceptions::throws('Error', 'invalidInput', $type);	
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
	public function setEncoding($type = 'input', $charset = 'utf-8')
	{
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
	public function mimesDecode(String $encodedHeaders, $mode = 0, $charset = NULL)
	{
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
	public function mimeDecode(String $encodedHeader, $mode = 0, $charset = NULL)
	{
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
	public function mimeEncode(String $fieldName, String $fieldValue, Array $preferences = NULL)
	{
		return iconv_mime_encode($fieldName, $fieldValue, (array) $preferences);
	}
}