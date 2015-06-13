<?php
/************************************************************/
/*                      IMG COMPONENT                       */
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
* IMG                                                                                     *
*******************************************************************************************
| Sınıfı Kullanırken      :	$this->cimg->     	     								      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class CImg extends ComponentHtmlCommon
{
	/******************************************************************************************
	* SRC                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulacak linkin url adresidir.					 			      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @url => Linkin bağlantı kurulacağı url adresi.					      	  |
	|          																				  |
	| Örnek Kullanım: ->content('Merhaba')         											  |
	|          																				  |
	******************************************************************************************/
	public function src($url = '')
	{
		if( ! is_string($url) )
		{
			return $this;	
		}
		
		if( ! isEmail($url) )
		{ 
			return $this;
		}
		
		$this->link['url'] = $url;
		
		return $this;
	}
	
	/******************************************************************************************
	* TITLE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Resim üzerine gelindiğinde görünen yazı.					 			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @title => Başlık.					      	  				  	  		  |
	|          																				  |
	| Örnek Kullanım: ->title('Başlık')         											  |
	|          																				  |
	******************************************************************************************/
	public function title($title = '')
	{
		if( ! isValue($title) )
		{
			return $this;	
		}
		
		$this->link['attr']['title'] = $title;
		
		return $this;
	}
	
	/******************************************************************************************
	* WIDTH                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Resim genişlik değeri.									 			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @width => Genişlik.					      	  				  	  	  |
	|          																				  |
	| Örnek Kullanım: ->width(200)         											  		  |
	|          																				  |
	******************************************************************************************/
	public function width($width = 0)
	{
		if( ! is_numeric($width) )
		{
			return $this;	
		}
		
		$this->link['attr']['width'] = $width;
		
		return $this;
	}
	
	/******************************************************************************************
	* HEIGHT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Resim yükseklik değeri.									 			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @height => Yükseklik.					      	  				  	  	  |
	|          																				  |
	| Örnek Kullanım: ->height(200)         											  	  |
	|          																				  |
	******************************************************************************************/
	public function height($height = 0)
	{
		if( ! is_numeric($height) )
		{
			return $this;	
		}
		
		$this->link['attr']['height'] = $height;
		
		return $this;
	}
	
	/******************************************************************************************
	* SIZE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Resim genişlik ve yükseklik değeri.									  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @width => Genişlik.					      	  				  	  	  |
	| 2. numeric var @height => Yükseklik.					      	  				  	  	  |
	|          																				  |
	| Örnek Kullanım: ->size(200, 200)         											  	  |
	|          																				  |
	******************************************************************************************/
	public function size($width = '', $height = '')
	{
		if( ! ( is_numeric($height) || is_numeric($width) ) )
		{
			return $this;	
		}
		
		if( ! empty($width) )  
		{
			$this->link['attr']['width'] = $width;
		}
		
		if( ! empty($height) ) 
		{
			$this->link['attr']['height'] = $height;
		}
		
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
		
		$attr['alt'] = ( ! isset($attr['alt']) )
					   ? ''
					   : $attr['alt'];
		
		// Html nesnesi oluşturuluyor... ----------------------------
		$create  = '<img src="'.$url.'"'.$this->_attributes($attr).'>';
		// ----------------------------------------------------------
		
		return $create;
	}
}