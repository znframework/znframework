<?php
class Exceptions extends Exception
{
	/***********************************************************************************/
	/* ZN EXCEPTION LIBRARY	     			                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: ZNException
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Exceptions::, $this->znexception, zn::$use->znexception, uselib('znexception')
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
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "Exceptions::$method()"));	
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
	* TABLE         	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Hatayı yakalayıp özel bir çerçeve ile basması için oluşturulmuştur.     |
	|          																				  |
	******************************************************************************************/	
	public static function table($msg = '', $file = '', $line = '')
	{
		echo self::_template($msg, $file, $line);  
	}
	
	/******************************************************************************************
	* RESTORE HANDLER                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Bir önceki hata eylemcisini devreye sokar.			   				  |
	|          																				  |
	******************************************************************************************/	
	public static function restore()
	{
		return restore_exception_handler();
	}
	
	/******************************************************************************************
	* SET HANDLER 		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir önceki hata eylemcisini devreye sokar.			   				  |
	|          																				  |
	******************************************************************************************/	
	public static function handler($handler = 0)
	{
		if( ! is_callable($handler) )
		{
			return self::set(lang('Error', 'callableParameter', '1.(handler)'));	
		}

		return set_exception_handler($handler);
	}
}