<?php
class __USE_STATIC_ACCESS__JS
{
	/***********************************************************************************/
	/* SCRIPT COMPONENT	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: JS
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->JS, zn::$use->JS, uselib('JS')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* 
	 * Jquery Ready durumu 
	 *
	 * @var bool true 
	 */
	protected $ready = true;
	
	/* 
	 * Script text türü 
	 *
	 * @var string text/javascript 
	 */
	protected $type  = 'text/javascript';
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "JS::$method()"));	
	}
	
	/******************************************************************************************
	* TYPE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Scriptin türünü ayarlamak için kullanılır.       	  		    		  |
	
	  @param string $type text/javascript
	  
	  @return this
	|          																				  |
	******************************************************************************************/
	public function type($type = 'text/javascript')
	{
		if( ! is_string($type) )
		{
			Error::set(lang('Error', 'stringParameter', 'type'));
			return $this;	
		}
		
		$this->type = $type;
		
		return $this;
	}
	
	/******************************************************************************************
	* LIBRARY                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Yüklemek istediğiniz harici script kütüphanelerini dahil etmek içindir. |
	
	  @param string arguments k1, k2 ... kN
	  
	  @return this
	|          																				  |
	******************************************************************************************/
	public function library()
	{
		$arguments = array_unique(func_get_args());
		Import::script($arguments);
		
		return $this;
	}
	
	/******************************************************************************************
	* OPEN                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Script tagını açmak için kullanılır.           	  		    		  |
	
	  @param bool $ready true
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function open($ready = true)
	{		
		$this->ready = $ready;
		
		$script  = "";
		$script .= Import::script('jquery', true);
		$script .= "<script type=\"$this->type\">".eol();
		
		if( $this->ready === true )
		{
			$script .= "$(document).ready(function()".eol()."{".eol();
		}
		
		return $script;
	}

	/******************************************************************************************
	* CLOSE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Script tagını kapatmak için kullanılır.          	  		    		  |
	
	  @param void
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function close()
	{	
		$script = "";
		
		if( $this->ready === true )
		{
			$script .= eol().'});'.eol();
		}
		
		$script .=  '</script>'.eol();
		
		return $script;
	}	
}