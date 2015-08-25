<?php
class JSCommon
{
	/***********************************************************************************/
	/* JQUERY COMMON COMPONENT	      		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: JqueryCommon
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Jquery bileşenleri tarafından kullanılmaktadır.
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* BOOL TO STR                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Parametre mantıksal türden string türe dönüştürülüyor. 	    		  |
	
	  @param bool $bool
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function _boolToStr($bool = true)
	{
		if( $bool === true )
		{
			return 'true';
		}
		elseif( $bool === false )
		{
			return 'false';
		}
		else
		{
			return $bool;	
		}
	}
	
	/******************************************************************************************
	* IS KEY SELECTOR                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Parametrenin seçici bir anahtar olup olmadığı kontrol ediliyor. 	 	  |
	
	  @param string $data
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	protected function _isKeySelector($data)
	{
		$keyword  = array('document', 'this', 'window');
		
		if( in_array($data, $keyword) )
		{
			return true;	
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* IS BOOL                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Parametrenin string mantıksal veri olup olmadığı kontrol ediliyor. 	  |
	
	  @param string $data
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	protected function _isBool($data)
	{
		$data = strtolower($data);
		
		if( $data === "true" || $data === "false" )
		{
			return true;	
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* IS JSON                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Parametrenin Json ver türü olup olmadığı kontrol ediliyor.    		  |
	
	  @param string $data
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	protected function _isJson($data)
	{
		if( preg_match('/\{.+\:.+\}/', $data) )
		{
			return true;	
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* IS FUNC                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Parametrenin fonksiyon olup olmadığı kontrol ediliyor. 	    		  |
	
	  @param array $array
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function _isFunc($data)
	{
		if( preg_match('/function.*\(.*\)/', $data) )
		{
			return true;	
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* OBJECT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Parametrenin veri türüne göre object türe dönüştürülme yapılır. 		  |
	
	  @param string/array $array
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function _object($array)
	{
		$object = '';
		
		if( is_array($array) )
		{		
			$object  = '';	
			$object .= "{";
			if( ! empty($array)) foreach($array as $k => $v)
			{
				$object .= $k.":".$this->_isCode($v).", ";
			}
			$object  = substr($object, 0, -2);
			$object .= "}";
		}
		else
		{
			$object = eol()."\"$array\"";	
		}
		
		return $object;
	}	
	
	/******************************************************************************************
	* PARAMS                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Parametrenin ne tür veri içerdiğinin kontrolü yapılır. 	    		  |
	
	  @param array $array
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function _params($array = array())
	{
		$implode = '';
		
		if( is_array($array) )
		{
			if( ! empty($array) ) foreach( $array as $v )
			{
				if( ! empty($v) )
				{
					$implode .= $this->_isCode($v).",";
				}
			}
			
			$implode = rtrim($implode, ",");	
		}
		else
		{
			if( ! empty($array) )
			{
				$implode = $this->_isCode($array);
			}	
		}
		
		return $implode;
	}
	
	/******************************************************************************************
	* CDE                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Parametrenin ne tür veri içerdiğinin kontrolü yapılır. 	    		  |
	
	  @param string $code
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function _isCode($code)
	{
		$cd = '';
		
		if( is_numeric($code) || $this->_isBool($code) || $this->_isJson($code) || $this->_isFunc($code) ) 
		{
			$cd = $code;
		}
		else 
		{
			$cd = "\"$code\"";
		}
		
		return $cd;
	}
}