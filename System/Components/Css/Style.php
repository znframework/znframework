<?php
/************************************************************/
/*                    COMPONENT  STYLE                   	*/
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* STYLE                                                                                   *
*******************************************************************************************
| Dahil(Import) Edilirken : Css/Style   		     							          |
| Sınıfı Kullanırken      :	$this->style->       									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class ComponentCssStyle
{
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
		
		import::style($arguments);
		
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
		$script = "<style type=\"$this->type\">".ln();
		
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
		$script =  '</style>'.ln();
		return $script;
	}	
}