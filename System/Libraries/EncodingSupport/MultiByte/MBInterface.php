<?php 
namespace ZN\EncodingSupport;

interface MBInterface
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
	* SPLIT                  	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Çok baytlı bir dizgeyi düzenli ifade ile parçalara ayırır.			  | 
		
	  @param  string  $string 
	  @param  string  $pattern
	  @param  numeric $limit -1 
	  @return array
	|														                                  |
	******************************************************************************************/
	public function split($string, $pattern, $limit);
	
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
	public function search($str, $needle, $type, $case);
	
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
	public function section($str, $starting, $count, $encoding);
	
	/******************************************************************************************
	* PARSE GET             	                                                              *
	*******************************************************************************************
	| Genel Kullanım: GET verisini çözümler ve küresel değişkenleri tanımlar.				  | 
		
	  @param  string  $string 
	  @return array
	|														                                  |
	******************************************************************************************/
	public function parseGet($string);
	
	/******************************************************************************************
	* CHECK                  	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dizgenin belirtilen kodlama için geçerli olup olmadığını sınar.		  | 
		
	  @param  string $string
	  @param  string $encoding
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function check($string, $encoding);
	
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
	public function casing($string, $flag, $encoding);
	
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
	public function convert($string, $toEncoding, $fromEncoding);
	
	/******************************************************************************************
	* MIME DECODE            	                                                              *
	*******************************************************************************************
	| Genel Kullanım: MIME başlık alanındaki dizgeyi dönüştürür.							  | 
		
	  @param  string $string
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function mimeDecode($string);
	
	/******************************************************************************************
	* MIME ENCODE            	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dizgeyi MIME başlığı için kodlar.										  | 
		
	  @param  string $string
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function mimeEncode($string, $encoding, $transferEncoding, $crlf, $indent);
	
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
	public function toEntity($string, $convertMap, $encoding);
	
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
	public function toNumeric($string, $convertMap, $encoding);
	
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
	public function detect($string, $encodingList, $strict);
	
	/******************************************************************************************
	* DETECT ORDER          	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Karakter kodlaması algılama sırasını tanımlar.		        		  | 
		
	  @param  mixed  $encodingList	ASCII, UTF-8
	  @return mixed  
	|														                                  |
	******************************************************************************************/
	public function detectOrder($encodingList);
	
	/******************************************************************************************
	* ALIASES        	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Karakter setinin takma adını döndürür.								  | 
		
	  @param  string $string
	  @return array  
	|														                                  |
	******************************************************************************************/
	public function aliases($string);
	
	/******************************************************************************************
	* INFO                  	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Mbstring değiştirgelerinin dahili ayarlarını döndürür.		          | 
		
	  @param  string  $string all
	  @return array  
	|														                                  |
	******************************************************************************************/
	public function info($string);
	
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
	public function httpInput($type);
	
	/******************************************************************************************
	* HTTP INPUT              	                                                              *
	*******************************************************************************************
	| Genel Kullanım: HTTP çıktı karakter kodlamasını tanımlar.		       					  | 
		
	  @param  type  $encoding UTF-8
	  @return mixed   
	|														                                  |
	******************************************************************************************/
	public function httpOutput($encoding);
	
	/******************************************************************************************
	* LANG                  	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Geçerli dili tanımlar.		     				  					  | 
		
	  @param  lang  $lang neutral
	  @return mixed   
	|														                                  |
	******************************************************************************************/
	public function lang($lang);
	
	/******************************************************************************************
	* ENCODINGS              	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Desteklenen kodlamaların tamamını bir dizi olarak döndürür.			  | 
		
	  @param  void
	  @return array   
	|														                                  |
	******************************************************************************************/
	public function encodings();
	
	/******************************************************************************************
	* OUTPUT HANDLER          	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Çıktı tamporundaki karakter kodlamasını dönüştüren geriçağırım işlevi.  | 
		
	  @param  string  $contents
	  @param  numeric $status   
	  @return string
	|														                                  |
	******************************************************************************************/
	public function outputHandler($contents, $status);
	
	/******************************************************************************************
	* MIME NAME              	                                                              *
	*******************************************************************************************
	| Genel Kullanım:  MIME karakter kümesi dizgesini döndürür.								  | 
		
	  @param  string  $encoding 
	  @return string
	|														                                  |
	******************************************************************************************/
	public function mimeName($encoding);
}