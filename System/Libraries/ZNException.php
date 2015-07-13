<?php
class ZNException extends Exception
{
	/***********************************************************************************/
	/* ZN EXCEPTION LIBRARY	     			                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: ZNException
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: znexception::, $this->znexception, zn::$use->znexception, uselib('znexception')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
		
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
		
		return Import::template('ExceptionTable', $exceptionData, true);
	}
	
	/******************************************************************************************
	* GET ERROR HANDLER	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Hatayı yakalayıp özel bir çerçeve ile basması için oluşturulmuştur.     |
	|          																				  |
	******************************************************************************************/	
	public static function getErrorHandler($no, $msg, $file, $line)
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