<?php
namespace ZN\ErrorHandling;

class InternalExceptions extends \Exception implements ExceptionsInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
		
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
	private function _template($msg, $file, $line)
	{
		$exceptionData = array
		(
			'message' => $msg,
			'file'	  => $file,
			'line'    => $line
		);
		
		return \Import::template('ExceptionTable', $exceptionData, true);
	}
	
	/******************************************************************************************
	* TABLE         	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Hatayı yakalayıp özel bir çerçeve ile basması için oluşturulmuştur.     |
	|          																				  |
	******************************************************************************************/	
	public function table($no = '', $msg = '', $file = '', $line = '')
	{
		$lang    = lang('Error');
		$message = $lang['line'].':'.$line.', '.$lang['file'].':'.$file.', '.$lang['message'].':'.$msg;
		
		report('GeneralError', $message, 'GeneralError');
		
		echo $this->_template($msg, $file, $line);  
	}
	
	/******************************************************************************************
	* RESTORE HANDLER                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Bir önceki hata eylemcisini devreye sokar.			   				  |
	|          																				  |
	******************************************************************************************/	
	public function restore()
	{
		return restore_exception_handler();
	}
	
	/******************************************************************************************
	* SET HANDLER 		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir önceki hata eylemcisini devreye sokar.			   				  |
	|          																				  |
	******************************************************************************************/	
	public function handler($handler = 0)
	{
		if( ! is_callable($handler) )
		{
			return $this->set(lang('Error', 'callableParameter', '1.(handler)'));	
		}

		return set_exception_handler($handler);
	}
}