<?php
/************************************************************/
/*                     LINK COMPONENT                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Html;

require_once(COMPONENTS_DIR.'Html/Common.php');

use Html\ComponentHtmlCommon;
/******************************************************************************************
* LINK                                                                                    *
*******************************************************************************************
| Dahil(Import) Edilirken : CLink              							     		      |
| Sınıfı Kullanırken      :	$this->clink->     	     								      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class CLink extends ComponentHtmlCommon
{
	/******************************************************************************************
	* HREF                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulacak linkin url adresidir.					 			      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @url => Linkin bağlantı kurulacağı url adresi.					      	  |
	|          																				  |
	| Örnek Kullanım: ->content('Merhaba')         											  |
	|          																				  |
	******************************************************************************************/
	public function href($url = '')
	{
		if( ! is_string($url) )
		{
			return $this;	
		}
		
		if( ! isUrl($url) && ! strstr($url, '#'))
		{ 
			$url = siteUrl($url);
		}
		
		$this->link['url'] = $url;
		
		return $this;
	}
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html nesnesini oluşturmak için kullanılan son yöntemdir.		          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      | 
	| 1. string var @element => Oluşturulacak html nesnesi.					      	  		  |
	| 2. boolean var @closing => </x> tagı ile kapatılsı mı?. Varsayılan: true				  |
	|          																				  |
	| Örnek Kullanım: ->create('<br>', false);        								          |
	|          																				  |
	******************************************************************************************/
	public function create($url = '', $content = '')
	{	
		$attr = ( isset($this->link['attr']) )
				? $this->link['attr']
				: '';

		$url = ( isset($this->link['url']) )
			   ? $this->link['url']
			   : $url;
		
	    $content = ( isset($this->link['content']) )
				   ? $this->link['content']
				   : $content;
			   
	    $content = ( empty($content) )
		   		   ? $url
		   		   : $content;
			
		
		// Html nesnesi oluşturuluyor... ----------------------------
		$create  = '<a href="'.$url.'"'.$this->_attributes($attr).'>';
		$create .= $content;
		$create .= '</a>';
		// ----------------------------------------------------------
		
		return $create;
	}
}