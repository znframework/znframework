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
	
	protected function _argumentPassed($msg)
	{
		preg_match
		(
			'/^Argument\s(\d)+\spassed\sto\s(.*?)::(.*?)\smust\sbe\s\w+\s\w+\s\w+\s(.*?),\s(\w+)\sgiven/xi',
			$msg,
			$match
		);

		$message  = ! empty($match[0]) ? $match[0] : NULL;
		$argument = ! empty($match[1]) ? $match[1] : NULL;
		$class    = ! empty($match[2]) ? $match[2] : NULL;
		$method   = ! empty($match[3]) ? $match[3] : NULL;
		$type     = ! empty($match[4]) ? strtolower(divide($match[4], '\\', -1)) : NULL;
		$data     = ! empty($match[5]) ? strtolower($match[5]) : NULL;

		if( empty($match) )
		{
			return false;
		}

		return (object)
		[
			'message'  => $message,
			'argument' => $argument,
			'class'    => $class,
			'method'   => $method,
			'type'	   => $type,
			'data'	   => $data
		];
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

		$debug = \Errors::debugBackTrace(['object' => 9, 'file' => 9, 'default' => 5]);

		$passed = $this->_argumentPassed($msg);
		
		if( ! empty($passed) )	
		{
			if( $passed->type === $passed->data )
			{
				return false;
			}
			else
			{
				$langMessage1 = $debug['className'].'::'.$passed->method.' p'.$passed->argument.':';
				$langMessage2 = '`'.$passed->type.'`';

				$exceptionData = array
				(
					'message' => lang('Error', 'typeHint', ['&' => $langMessage1, '%' => $langMessage2]),
					'file'	  => $debug['file'],
					'line'    => $debug['line']
				);
			}
		}
		
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