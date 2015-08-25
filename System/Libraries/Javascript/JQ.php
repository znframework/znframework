<?php
class __USE_STATIC_ACCESS__JQ extends JSCommon
{
	/***********************************************************************************/
	/* JQUERY BUILDER LIBRARY 	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: JQBuilder
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: JQ::, $this->JQ, zn::$use->JQ, uselib('JQ')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Selector Variables
	 * Selector 
	 * this, #custom, .example
	 *
	 * $(this), $("#custom"), $(".example") 
	 */
	protected $selector = 'this';
	
	/* Property Variables
	 * Property 
	 * css, attr, val
	 *
	 * $.css(), .attr(), .val()
	 */
	 
	protected $property = '';
	
	/* Callback Variables
	 * Data Function
	 * alert("example");
	 *
	 * function(data){alert("example");}
	 */
	protected $func = '';
	
	/* Attributes Variables
	 * Attributes 
	 * 
	 *
	 * {key:val} 
	 */
	protected $attr = '';
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "JQ::$method()"));	
	}
	
	/******************************************************************************************
	* SELECTOR                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Jquery seçicisi oluşturmak içindir.             	  		    		  |
	
	  @param string $selector
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function selector($selector = '')
	{
		if( ! isChar($selector) )
		{
			Error::set(lang('Error', 'valueParameter', 'selector'));
			return $this;	
		}
		
		if( $this->_isKeySelector($selector) )
		{
			$code = $selector;	
		}
		else
		{
			$code = "\"$selector\"";	
		}
		
		return "$($code)";
	}	
	
	/******************************************************************************************
	* PROPERTY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Jquery propertisi oluşturmak içindir.             	  	    		  |
	
	  @param string $property
	  @param array  $params
	  @param bool   $comma false
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function property($property = '', $params = array(), $comma = false)
	{
		if( ! is_string($property) || empty($property) )
		{
			return Error::set(lang('Error', 'stringParameter', 'property'));	
		}

		return ".$property(". $this->_params($params).")".($comma === true ? ";" : "");
	}
	
	/******************************************************************************************
	* FUNC                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Jquery fonksiyonu oluşturmak içindir.             	  	    		  |
	
	  @param string $params
	  @param string $code
	  @param bool   $comma false
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function func($params = '', $code = '', $comma = false)
	{
		if( empty($code) )
		{
			return false;	
		}
		
		return "function($params){".$code."}".($comma === true ? ";" : "");
	}
	
	/******************************************************************************************
	* CALLBACK                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Jquery fonksiyonu oluşturmak içindir.             	  	    		  |
	
	  @param string $params
	  @param string $code
	  @param bool   $comma false
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function callback($params = '', $code = '', $comma = false)
	{
		return $this->func($params, $code, $comma);
	}
	
	/******************************************************************************************
	* COMBINE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Genel jquery komutu oluşturmak için kullanılır.    		    		  |
	
	  @param string $selector
	  @param string $property
	  @param array  $params
	  @param string $callback
	  @param bool   $comma false
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function combine($selector = '', $property = '', $params = '', $callback = '', $comma = false)
	{
		if( ! empty($callback) )
		{
			$params[]= array($this->func('e', $callback));
		}
		
		return $this->selector($selector).$this->property($property, $params, $comma);		   
	}
	
	/******************************************************************************************
	* SERIALIZE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Jquery serialize yöntemini kullanmak içindir.     	  	    		  |
	
	  @param string $selector
	  @param array  $func
	  @param bool   $comma false
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function serialize($selector = '', $params = array(), $comma = false)
	{
		return $this->combine($selector, 'serialize', $params, '', $comma);
	}
}