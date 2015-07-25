<?php
class __USE_STATIC_ACCESS__CMailto extends CHtmlCommon
{
	/***********************************************************************************/
	/* MAIL TO COMPONENT	  	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CMailTo
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->cmailto, zn::$use->cmailto, uselib('cmailto')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* EMAIL                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulacak linkin url adresidir.					 			      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @url => Linkin bağlantı kurulacağı url adresi.					      	  |
	|          																				  |
	| Örnek Kullanım: ->content('Merhaba')         											  |
	|          																				  |
	******************************************************************************************/
	public function email($url = '')
	{
		if( ! is_string($url) )
		{
			Error::set(lang('Error', 'stringParameter', 'url'));
			return $this;	
		}
		
		if( ! isEmail($url) )
		{ 
			Error::set(lang('Error', 'emailParameter', 'url'));
			return $this;
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
		$create  = '<a href="mailto:'.$url.'"'.$this->_attributes($attr).'>';
		$create .= $content;
		$create .= '</a>';
		// ----------------------------------------------------------
		
		return $create;
	}
}