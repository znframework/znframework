<?php 
namespace ZN\EncodingSupport;

class InternalMB implements MBInterface, \ErrorControlInterface
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
	
	/******************************************************************************************
	* SPLIT                  	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Çok baytlı bir dizgeyi düzenli ifade ile parçalara ayırır.			  | 
		
	  @param  string  $string 
	  @param  string  $pattern
	  @param  numeric $limit -1 
	  @return array
	|														                                  |
	******************************************************************************************/
	public function split(String $string, String $pattern, $limit = -1)
	{
		return mb_split($pattern, $string, $limit);
	}
	
	/******************************************************************************************
	* SEARCH                  	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dizge içerisinde istenilen karakter kümesini arar.					  | 
		
	  @param  string  $str 
	  @param  string  $neddle
	  @param  string  $type str/string, pos/position
	  @param  bool    $case true 
	  @return mixed
	|														                                  |
	******************************************************************************************/
	public function search(String $str, String $needle, $type = "str", $case = true)
	{
		return \Strings::search($str, $needle, $type, $case);
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
	public function section(String $str, $starting = 0, $count = NULL, $encoding = 'UTF-8')
	{
		if( ! isCharset($encoding) )
		{
			return ! $this->error = lang('Error', 'charsetParameter', '3.($encoding)');	
		}

		return \Strings::section($str, $starting, $count, $encoding);
	}
	
	/******************************************************************************************
	* PARSE GET             	                                                              *
	*******************************************************************************************
	| Genel Kullanım: GET verisini çözümler ve küresel değişkenleri tanımlar.				  | 
		
	  @param  string  $string 
	  @return array
	|														                                  |
	******************************************************************************************/
	public function parseGet(String $string)
	{
		mb_parse_str($string, $result);
		
		return $result;
	}
	
	/******************************************************************************************
	* CHECK                  	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dizgenin belirtilen kodlama için geçerli olup olmadığını sınar.		  | 
		
	  @param  string $string
	  @param  string $encoding
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function check(String $string, $encoding = 'UTF-8')
	{
		if( ! isCharset($encoding) )
		{
			return ! $this->error = lang('Error', 'charsetParameter', '2.($encoding)');	
		}
		
		return mb_check_encoding($string, $encoding);
	}
	
	/******************************************************************************************
	* CONVERT CASE             	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Bir dizgeye büyük-küçük harf dönüşümü uygular.						  | 
		
	  @param  string $string
	  @param  string $flag 		upper, lower, title
	  @param  string $encoding
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function casing(String $string, $flag = 'upper', $encoding = 'UTF-8')
	{
		if( ! isCharset($encoding) )
		{
			return ! $this->error = lang('Error', 'charsetParameter', '3.($encoding)');	
		}
		
		return mb_convert_case($string, \Convert::toConstant($flag, 'MB_CASE_'), $encoding);
	}
	
	/******************************************************************************************
	* CONVERT ENCODING         	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Karakter kodlaması dönüşümü yapar.									  | 
		
	  @param  string $string
	  @param  string $toEncoding   UTF-8
	  @param  string $fromEncoding ASCII, UTF-8
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function convert(String $string, $toEncoding = 'UTF-8', $fromEncoding = 'ASCII, UTF-8')
	{
		if( ! isCharset($toEncoding) )
		{
			return ! $this->error = lang('Error', 'charsetParameter', '2.($toEncoding)');
		}
		
		return mb_convert_encoding($string, $toEncoding, $fromEncoding);
	}
	
	/******************************************************************************************
	* MIME DECODE            	                                                              *
	*******************************************************************************************
	| Genel Kullanım: MIME başlık alanındaki dizgeyi dönüştürür.							  | 
		
	  @param  string $string
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function mimeDecode(String $string)
	{
		return mb_decode_mimeheader($string);
	}
	
	/******************************************************************************************
	* MIME ENCODE            	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dizgeyi MIME başlığı için kodlar.										  | 
		
	  @param  string $string
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function mimeEncode(String $string, $encoding = 'UTF-8', $transferEncoding = 'B', $crlf = "\r\n", $indent = 0)
	{
		if( ! isCharset($encoding) )
		{
			return ! $this->error = lang('Error', 'charsetParameter', '2.(encoding)');	
		}

		return mb_encode_mimeheader($string, $encoding, $transferEncoding, $crlf, $indent);
	}
	
	/******************************************************************************************
	* TO ENTITY      	 		                                                              *
	*******************************************************************************************
	| Genel Kullanım: HTML sayısal karakter gösterimini karaktere dönüştürür.				  | 
		
	  @param  string $string
	  @param  array  $convertMap
	  @param  string $encoding UTF-8
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function toEntity(String $string, Array $convertMap = NULL, $encoding = 'UTF-8')
	{
		if( ! isCharset($encoding) )
		{
			return ! $this->error = lang('Error', 'charsetParameter', '3.(encoding)');	
		}

		return mb_decode_numericentity($string, (array) $convertMap, $encoding);
	}
	
	/******************************************************************************************
	* TO NUMERIC            	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Karakter kodlarını HTML sayısal karakter gösterimlerine dönüştürür.	  | 
		
	  @param  string $string
	  @param  array  $convertMap
	  @param  string $encoding UTF-8
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function toNumeric(String $string, Array $convertMap = NULL, $encoding = 'UTF-8')
	{
		if( ! isCharset($encoding) )
		{
			return ! $this->error = lang('Error', 'charsetParameter', '3.(encoding)');	
		}

		return mb_encode_numericentity($string, $convertMap, $encoding);
	}
	
	/******************************************************************************************
	* DETECT                	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Karakter kodlamasını algılar.				  							  | 
		
	  @param  string $string
	  @param  array  $encodingList	ASCII, UTF-8
	  @param  bool   $strict		false
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function detect(String $string, $encodingList = ['ASCII', 'UTF-8'], $strict = false)
	{	
		return mb_detect_encoding($string, (array) $encodingList, $strict);
	}
	
	/******************************************************************************************
	* DETECT ORDER          	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Karakter kodlaması algılama sırasını tanımlar.		        		  | 
		
	  @param  mixed  $encodingList	ASCII, UTF-8
	  @return mixed  
	|														                                  |
	******************************************************************************************/
	public function detectOrder($encodingList = ['ASCII', 'UTF-8'])
	{
		return mb_detect_order((array) $encodingList);
	}
	
	/******************************************************************************************
	* ALIASES        	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Karakter setinin takma adını döndürür.								  | 
		
	  @param  string $string
	  @return array  
	|														                                  |
	******************************************************************************************/
	public function aliases(String $string = NULL)
	{
		return mb_encoding_aliases($string);
	}
	
	/******************************************************************************************
	* INFO                  	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Mbstring değiştirgelerinin dahili ayarlarını döndürür.		          | 
		
	  @param  string  $string all
	  @return array  
	|														                                  |
	******************************************************************************************/
	public function info($string = 'all')
	{
		return mb_get_info($string);
	}
	
	/******************************************************************************************
	* HTTP INPUT              	                                                              *
	*******************************************************************************************
	| Genel Kullanım: HTTP girdi karakter kodlamasını algılar.		       					  | 
		
	  @param  type  $type GET için "G", 
	  					  POST için "P", 
						  COOKIE için "C", D
						  Sting için "S", 
						  Liste için "L",
						  Tam liste için "I"
	  @return mixed   
	|														                                  |
	******************************************************************************************/
	public function httpInput($type = 'I')
	{
		return mb_http_input($type);
	}
	
	/******************************************************************************************
	* HTTP INPUT              	                                                              *
	*******************************************************************************************
	| Genel Kullanım: HTTP çıktı karakter kodlamasını tanımlar.		       					  | 
		
	  @param  type  $encoding UTF-8
	  @return mixed   
	|														                                  |
	******************************************************************************************/
	public function httpOutput($encoding = 'UTF-8')
	{
		if( ! isCharset($encoding) )
		{
			return ! $this->error = lang('Error', 'charsetParameter', '1.(encoding)');	
		}
		
		return mb_http_output($encoding);
	}
	
	/******************************************************************************************
	* LANG                  	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Geçerli dili tanımlar.		     				  					  | 
		
	  @param  lang  $lang neutral
	  @return mixed   
	|														                                  |
	******************************************************************************************/
	public function lang($lang = 'neutral')
	{
		return mb_language($lang);
	}
	
	/******************************************************************************************
	* ENCODINGS              	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Desteklenen kodlamaların tamamını bir dizi olarak döndürür.			  | 
		
	  @param  void
	  @return array   
	|														                                  |
	******************************************************************************************/
	public function encodings()
	{
		return mb_list_encodings();
	}
	
	/******************************************************************************************
	* OUTPUT HANDLER          	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Çıktı tamporundaki karakter kodlamasını dönüştüren geriçağırım işlevi.  | 
		
	  @param  string  $contents
	  @param  numeric $status   
	  @return string
	|														                                  |
	******************************************************************************************/
	public function outputHandler(String $contents, $status = 0)
	{
		return mb_output_handler($contents, $status);
	}
	
	/******************************************************************************************
	* MIME NAME              	                                                              *
	*******************************************************************************************
	| Genel Kullanım:  MIME karakter kümesi dizgesini döndürür.								  | 
		
	  @param  string  $encoding 
	  @return string
	|														                                  |
	******************************************************************************************/
	public function mimeName($encoding = 'UTF-8')
	{
		if( ! isCharset($encoding) )
		{
			return ! $this->error = lang('Error', 'stringParameter', '1.(encoding)');	
		}
		
		return mb_preferred_mime_name($encoding);
	}
}