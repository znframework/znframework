<?php
class CJqueryCommon
{
	/***********************************************************************************/
	/* JQUERY COMMON COMPONENT	      		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CJqueryCommon
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Jquery bileşenleri tarafından kullanılmaktadır.
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
	
	protected function _object($array)
	{
		
		if( is_array($array))
		{	
			$object  = '';	
			$object .= "\t{";
			
			if( ! empty($array) ) foreach($array as $k => $v)
			{
				if( is_numeric($v) || $this->_isBool($v) || $this->_isJson($v) || $this->_isFunc($v) ) 
				{
					$object .= $k.":$v, ";
				}
				else 
				{
					$object .= $k.":\"$v\", ";
				}
			}
			
			$object  = substr($object, 0, -2);
			$object .= "}";
		}
		else
		{
			$object = eol()."\t\t\"$array\"";	
		}
		
		return $object;
	}	
	
	protected function _params($array = array())
	{
		$implode = '';
		
		if( ! empty($array) ) foreach( $array as $v )
		{
			if( is_numeric($v) || $this->_isBool($v) || $this->_isJson($v) || $this->_isFunc($v) ) 
			{
				$implode .= "$v,";
			}
			else 
			{
				$implode .= "\"$v\",";
			}	
		}
		
		$implode = substr($implode, 0, -1);	
		
		return $implode;
	}
}