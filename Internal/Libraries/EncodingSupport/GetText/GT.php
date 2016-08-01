<?php 
namespace ZN\EncodingSupport;

class InternalGT extends \CallController implements GTInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	public function __construct()
	{
		\Support::func('gettex', 'GT > Gettex()');
	}
	
	/******************************************************************************************
	* DATA                   	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Geçerli uygulama alanında bir iletiyi arar. 	    					  | 
		
	  @param  string $message
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function data(String $message)
	{
		return gettext($message);
	}
	
	/******************************************************************************************
	* LOCALE                 	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Yereli ayarlar. 	 													  | 
		
	  @param  int 	$category
	  @param  mixed $locale  
	  
	  @return bool
	|														                                  |
	******************************************************************************************/
	public function locale($category, $locale)
	{
		return setlocale(\Convert::toConstant($category, 'LC_'), $locale);
	}
	
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
	public function datas(String $msgId1, String $msgId2, $count = 0)
	{
		return ngettext($msgId1, $msgId2, $count);
	}
	
	/******************************************************************************************
	* CHANGE                	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Geçerli uygulama adını değiştirir. 	   			 					  | 
		
	  @param  string $domain
	  @param  string $message
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function change(String $domain, String $message)
	{
		return dgettext($domain, $message);
	}
	
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
	public function changes(String $domain, String $msgId1, String $msgId2, $count = 0)
	{
		return dngettext($domain, $msgId1, $msgId2, $count);
	}
	
	/******************************************************************************************
	* SEARCH                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Geçerli uygulama alanında bir iletiyi arar. 	    					  | 
		
	  @param  string  $domain
	  @param  string  $message
	  @param  numeric $category
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function search(String $domain, String $message, $category = 0)
	{
		return dcgettext($domain, $message, $category);
	}
	
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
	public function searches(String $domain, String $msgId1, String $msgId2, $count = 0, $category = 0)
	{
		return dcngettext($domain, $msgId1, $msgId2, $count, $category);
	}
	
	/******************************************************************************************
	* CODESET            	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Belli bir uygulamanın iletileri için karakter kodlaması tanımlar. 	  | 
		
	  @param  string $domain
	  @param  string $codeset
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function codeset(String $domain, String $codeset)
	{
		return bind_textdomain_codeset($domain, $codeset);
	}
	
	/******************************************************************************************
	* BIND DOMAIN              	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Belli bir uygulamanın iletileri için karakter kodlaması tanımlar. 	  | 
		
	  @param  string $domain
	  @param  string $directory
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function dir(String $domain, String $directory)
	{
		return bindtextdomain($domain, $directory);
	}
	
	/******************************************************************************************
	* DOMAIN                 	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Öntanımlı uygulama adını tanımlar. 	 								  | 
		
	  @param  string $textDomain
	  @return string  
	|														                                  |
	******************************************************************************************/
	public function name(String $textDomain)
	{
		return textdomain($textDomain);
	}
}