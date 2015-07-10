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
		$style = '
			border:solid 1px #E1E4E5;
			background:#F3F6F6;
			padding:20px 20px 20px 20px;
			font-family:monospace, Tahoma, Arial;
			color:#333;
		';
		
		$exStyle = 'color:#900;';
		
		$str  = "<div style=\"$style\">";
		$str .= lang('Error', 'message', $msg)."<br>";
		$str .= lang('Error', 'file', $file)."<br>";
		$str .= lang('Error', 'line', $line);
		$str .= '</div>';
		
		return $str;
	}
	
	/******************************************************************************************
	* GET LAST ERROR	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Hatayı yakalayıp özel bir çerçeve ile basması için oluşturulmuştur.     |
	|          																				  |
	******************************************************************************************/	
	public static function getLastError()
	{
		$errors = error_get_last();
		
		if( empty($errors) )
		{
			return false;	
		}
		
		return self::_template($errors['message'], $errors['file'], $errors['line']);  
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