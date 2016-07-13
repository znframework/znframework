<?php
namespace ZN\ViewObjects;

class InternalStyle implements Common\ViewObjectsInterface
{
	/***********************************************************************************/
	/* STYLE COMPONENT	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Style
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Style::, $this->Style, zn::$use->Style, uselib('Style')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Type Değişkeni
	 *  
	 * Metin türü bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $type 	= 'text/css';
	
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
			\Errors::set('Error', 'stringParameter', 'type');
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
	public function library(...$libraries)
	{
		\Import::style(...$libraries);
		
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
		$script = "<style type=\"$this->type\">".EOL;
		
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
		$script =  '</style>'.EOL;
		return $script;
	}	
}