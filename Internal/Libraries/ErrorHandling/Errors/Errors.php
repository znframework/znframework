<?php
namespace ZN\ErrorHandling;

class InternalErrors implements ErrorsInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Errors Değişkeni
	 *  
	 * Oluşan hatalar bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $errors;

	/******************************************************************************************
	* MESSAGE	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: getErrorMessage() yönteminin aynısıdır.  								  |
	|															                              |
	******************************************************************************************/	
	public function message(String $langFile, String $errorMsg, $ex = NULL)
	{
		return getErrorMessage($langFile, $errorMsg, $ex);
	}
	
	/******************************************************************************************
	* LAST		                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Son oluşan hata hakkında bilgi verir.						   			  |
	|          																				  |
	******************************************************************************************/	
	public function last($type = NULL)
	{
		return errorReport($type);
	}
	
	/******************************************************************************************
	* LOG	           	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir yerlere bir hata iletisi gönderir.					   			  |
	|          																				  |
	******************************************************************************************/	
	public function log($message = '', $type = 0, $destination = '', $header = '')
	{
		if( ! is_string($message) || ! is_string($destination) )
		{
			return $this->set(lang('Error', 'stringParameter', '1.(message) & 3.(destination)'));	
		}
		
		if( ! is_numeric($type) )
		{
			return $this->set(lang('Error', 'numericParameter', '2.(type)'));	
		}
		
		return error_log($message, $type, $destination, $header);
	}
	
	/******************************************************************************************
	* REPORT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Hangi PHP hatalarının raporlanacağını tanımlar.					      |
	|          																				  |
	******************************************************************************************/	
	public function report($level = 0)
	{
		if( ! is_numeric($level) )
		{
			return $this->set(lang('Error', 'numericParameter', '1.(level)'));	
		}
		
		if( ! empty($level) )
		{
			return error_reporting($level);
		}
		
		return error_reporting();
	}
	
	
	/******************************************************************************************
	* SET HANDLER 		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir önceki hata eylemcisini devreye sokar.			   				  |
	|          																				  |
	******************************************************************************************/	
	public function handler($handler = 0, $errorTypes = 0)
	{
		if( ! is_callable($handler) )
		{
			return $this->set(lang('Error', 'callableParameter', '1.(handler)'));	
		}
		
		if( empty($errorTypes) )
		{
			$errorTypes = E_ALL | E_STRICT;
		}
		
		return set_error_handler($handler, $errorTypes);
	}
	
	/******************************************************************************************
	* TRIGGER    		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Kullanıcı seviyesinde bir hata/uyarı/bilgi iletisi üretir.			  |
	|          																				  |
	******************************************************************************************/	
	public function trigger($msg = '', $errorType = E_USER_NOTICE)
	{
		if( ! is_string($msg) )
		{
			return $this->set(lang('Error', 'stringParameter', '1.(msg)'));	
		}

		return trigger_error ($msg, $errorType);
	}
	
	/******************************************************************************************
	* RESTORE HANDLER                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Bir önceki hata eylemcisini devreye sokar.			   				  |
	|          																				  |
	******************************************************************************************/	
	public function restore()
	{
		return restore_error_handler();
	}
}