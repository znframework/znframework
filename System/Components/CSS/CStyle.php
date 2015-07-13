<?php
class CStyle
{
	/***********************************************************************************/
	/* STYLE COMPONENT	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CStyle
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->cstyle, zn::$use->cstyle, uselib('cstyle')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Type Değişkeni
	 *  
	 * Metin türü bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $type 	= 'text/css';
	
	/******************************************************************************************
	* TYPE                                                                       			  *
	*******************************************************************************************
	| Genel Kullanım: Metin içeriğini değiştirmek için kullanılır. Varsayılan:text/css		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @type => Metin türü.  	  												  |		
	|          																				  |
	| Örnek Kullanım: ->type('text/css')			  					  					  |
	|          																				  |
	******************************************************************************************/
	public function type($type = 'text/css')
	{
		if( ! is_string($type) )
		{
			return $this;	
		}
		
		$this->type = $type;

		return $this;
	}
	
	/******************************************************************************************
	* LIBRARY                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Style tagı açılırken harici olarak dahil edilecek stil dosyaları varsa  |
	| bu yöntem kullanılır.					          							              |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. arguments var @args => Sırası ile ilave edilecek stil dosyaların adı yazılır.  	  |
	|          																				  |
	| Örnek Kullanım: ->library('stil1', 'stil2' ... 'stilN')			  					  |
	|          																				  |
	******************************************************************************************/
	public function library()
	{
		$arguments = array_unique(func_get_args());
		
		Import::style($arguments);
		
		return $this;
	}
	
	/******************************************************************************************
	* STYLE TAG OPEN                                                              			  *
	*******************************************************************************************
	| Genel Kullanım: Style tagı açmak için kullanılır. 						              |
	|          																				  |
	| Örnek Kullanım: ->open() // <style>	    		  					  				  |
	|          																				  |
	******************************************************************************************/
	public function open()
	{		
		$script = "<style type=\"$this->type\">".eol();
		
		return $script;
	}
	
	/******************************************************************************************
	* STYLE TAG CLOSE                                                              			  *
	*******************************************************************************************
	| Genel Kullanım: Style tagı açmak için kullanılır. 						              |
	|          																				  |
	| Örnek Kullanım: ->open() // <style>	    		  					  				  |
	|          																				  |
	******************************************************************************************/
	public function close()
	{	
		$script =  '</style>'.eol();
		return $script;
	}	
}