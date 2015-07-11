<?php
/************************************************************/
/*                     LIBRARY BUILDER                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* BUILDER                                                                             	  *
*******************************************************************************************
| Sınıfı Kullanırken : ZNException::, $this->ZNException, zn::$use->ZNException,		  | 
| uselib('ZNException')															  	  	  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class ZNException extends Exception
{	
	/******************************************************************************************
	* EXCEPTION REFERENCES                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Hatayı yakalayıp özel bir çerçeve ile basması için oluşturulmuştur.     |
	|          																				  |
	******************************************************************************************/	
	public function __toString()
	{
		return $this->_template($this->getMessage(), $this->getFile(), $this->getLine());
	}
	
	/******************************************************************************************
	* PRIVATE TEMPLATE                                                            			  *
	*******************************************************************************************
	| Genel Kullanım: Hata tablosu.     													  |
	|          																				  |
	******************************************************************************************/	
	private static function _template($msg, $file, $line)
	{
		$exceptionData = array
		(
			'message' => $msg,
			'file'	  => $file,
			'line'    => $line
		);
		
		return Import::something(SYSTEM_TEMPLATES_DIR.'ExceptionTable', $exceptionData, true);
	}
	
	/******************************************************************************************
	* GET LAST ERROR	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Hatayı yakalayıp özel bir çerçeve ile basması için oluşturulmuştur.     |
	|          																				  |
	******************************************************************************************/	
	public static function getLastError($no, $msg, $file, $line)
	{
		echo self::_template($msg, $file, $line);  
	}
	
	/******************************************************************************************
	* GET ERROR MESSAGE	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: getErrorMessage() yönteminin aynısıdır.  								  |
	|															                              |
	******************************************************************************************/	
	public static function getErrorMessage($langFile = '', $errorMsg = '', $ex = '')
	{
		return getErrorMessage($langFile, $errorMsg, $ex);
	}
}