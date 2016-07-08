<?php 
namespace ZN\EncodingSupport;

interface IVInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
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
	public function convert($string, $fromEncoding, $toEncoding);
	
	/******************************************************************************************
	* ENCODING                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Iconv için kullanılabilir kodlama setlerinin listesini döndürür.        | 
		
	  @param  void
	  @return array
	|														                                  |
	******************************************************************************************/
	public function encodings();
	
	/******************************************************************************************
	* GET ENCODING                                                                            *
	*******************************************************************************************
	| Genel Kullanım: iconv eklentisinin dahili yapılandırma değişkenlerini döndürür.         | 
		
	  @param  string $type -> input, output, internal
	  @return string
	|														                                  |
	******************************************************************************************/
	public function getEncoding($type);
	
	/******************************************************************************************
	* SET ENCODING                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Karakter kodlaması dönüşümü için geçerli karakter kümesini tanımlar.    | 
		
	  @param  string $type    -> input, output, internal
	  @param  string $charset -> geçerli karakter setlerinden herhangi biri
	  @return bool
	|														                                  |
	******************************************************************************************/
	public function setEncoding($type, $charset);
	
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
	public function mimesDecode($encodedHeaders, $mode, $charset);
	
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
	public function mimeDecode($encodedHeader, $mode, $charset);
	
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
	public function mimeEncode($fieldName, $fieldValue, $preferences);
}