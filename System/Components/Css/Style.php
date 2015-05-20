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
	protected $type 	= 'text/css';
	
	public function type($type = 'text/css')
	{
		if( ! is_string($type))
		{
			return $this;	
		}
		
		$this->type = $type;

		return $this;
	}
	
	public function library()
	{
		$arguments = array_unique(func_get_args());
		import::style($arguments);
		
		return $this;
	}
	
	public function open()
	{		
		$script = "<style type=\"$this->type\">\n";
		
		return $script;
	}
	
	public function close()
	{	
		$script =  '</style>'."\n";
		return $script;
	}	
}