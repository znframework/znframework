<?php 
namespace ZN\EncodingSupport;

interface GTInterface
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
	* DATA                   	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Geçerli uygulama alanında bir iletiyi arar. 	    					  | 
		
	  @param  string $message
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function data($message);
	
	/******************************************************************************************
	* LOCALE                 	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Yereli ayarlar. 	 													  | 
		
	  @param  int 	$category
	  @param  mixed $locale  
	  
	  @return bool
	|														                                  |
	******************************************************************************************/
	public function locale($category, $locale);
	
	/******************************************************************************************
	* DATAS                  	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Gettext işlevinin çoğul biçemli sürümü. 		    					  | 
		
	  @param  string  $msgId1
	  @param  string  $msgId2
	  @param  numeric $count
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function datas($msgId1, $msgId2, $count);
	
	/******************************************************************************************
	* CHANGE                	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Geçerli uygulama adını değiştirir. 	   			 					  | 
		
	  @param  string $domain
	  @param  string $message
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function change($domain, $message);
	
	/******************************************************************************************
	* CHANGES                	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Nettext işlevinin çoğul biçemli sürümü. 		    					  | 
	
	  @param  string  $domain
	  @param  string  $msgId1
	  @param  string  $msgId2
	  @param  numeric $count
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function changes($domain, $msgId1, $msgId2, $count);
	
	/******************************************************************************************
	* EARCH                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Geçerli uygulama alanında bir iletiyi arar. 	    					  | 
		
	  @param  string  $domain
	  @param  string  $message
	  @param  numeric $category
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function search($domain, $message, $category);
	
	/******************************************************************************************
	* SEARCHES                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Geçerli uygulama alanında bir iletiyi arar. 	    					  | 
		
	  @param  string  $domain
	  @param  string  $msgId1
	  @param  string  $msgId2
	  @param  numeric $count
	  @param  numeric $category
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function searches($domain, $msgId1, $msgId2, $count, $category);
	
	/******************************************************************************************
	* CODESET            	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Belli bir uygulamanın iletileri için karakter kodlaması tanımlar. 	  | 
		
	  @param  string $domain
	  @param  string $codeset
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function codeset($domain, $codeset);
	
	/******************************************************************************************
	* BIND DOMAIN              	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Belli bir uygulamanın iletileri için karakter kodlaması tanımlar. 	  | 
		
	  @param  string $domain
	  @param  string $directory
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function dir($domain, $directory);
	
	/******************************************************************************************
	* DOMAIN                 	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Öntanımlı uygulama adını tanımlar. 	 								  | 
		
	  @param  string $textDomain
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function name($textDomain);
}