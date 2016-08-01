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

	//----------------------------------------------------------------------------------------------------
    // Protected Argument Missed
    //----------------------------------------------------------------------------------------------------
    //
    // @param string $msg
    //
    //----------------------------------------------------------------------------------------------------
	protected function _argumentMissed($msg)
	{
		$exceptionData = false;

		preg_match
		(
			'/^Missing\sargument\s(\d)+\sfor/xi',
			$msg,
			$match
		);
		
		$message  = ! empty($match[0]) ? $match[0] : NULL;
		$argument = ! empty($match[1]) ? $match[1] : NULL;

		if( empty($match) )
		{
			return $exceptionData;
		}
		
		$debug = \Errors::debugBackTrace(['object' => 13, 'file' => 13, 'default' => 5]);

		$langMessage1 = $debug['className'].'::'.$debug['methodName'].'() p'.$argument.':';

		$exceptionData = array
		(
			'message' => lang('Error', 'emptyParameter', $langMessage1),
			'file'	  => $debug['file'],
			'line'    => $debug['line']
		);

		return $exceptionData;
	}
	
	//----------------------------------------------------------------------------------------------------
    // Protected Argument Passed
    //----------------------------------------------------------------------------------------------------
    //
    // @param string $msg
    //
    //----------------------------------------------------------------------------------------------------
	protected function _argumentPassed($msg)
	{
		$exceptionData = false;

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

		if( $type !== $data )
		{
			$debug = \Errors::debugBackTrace(['object' => 13, 'file' => 13, 'default' => 5]);

			$langMessage1 = $debug['className'].'::'.$method.' p'.$argument.':';
			$langMessage2 = '`'.$type.'`';

			$exceptionData = array
			(
				'message' => lang('Error', 'typeHint', ['&' => $langMessage1, '%' => $langMessage2]),
				'file'	  => $debug['file'],
				'line'    => $debug['line'],
			);

			return $exceptionData;
		}

		return true;
	}

	//----------------------------------------------------------------------------------------------------
    // Protected Throws
    //----------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $key
    // @param string $send
    //
    //----------------------------------------------------------------------------------------------------
	public function throws($message = '', $key = '', $send = '')
	{
		$debug = \Errors::debugBackTrace(['object' => 11, 'file' => 11, 'default' => 5]);

		if( $lang = lang($message, $key, $send) )
		{
			$message = $debug['className'].'::'.$debug['methodName'].'() '.$lang;
		}

		$this->table('', $message, $debug['file'], $debug['line']);
	}

	/******************************************************************************************
	* PRIVATE TEMPLATE                                                            			  *
	*******************************************************************************************
	| Genel Kullanım: Hata tablosu.     													  |
	|          																				  |
	******************************************************************************************/	
	private function _template($msg, $file, $line, $no)
	{
		global $application;

		if( ! \Config::get('Application', 'errorReporting') || empty($application['errorReporting']) )
		{
			return false;
		}
		
		if( in_array($no, \Config::get('Application', 'escapeErrors')) )
		{
			return false;
		}

		$debug = \Errors::debugBackTrace(['object' => 10, 'file' => 12, 'default' => 5]);

		$currentFile = str_replace('\\', '/', REAL_BASE_DIR.CURRENT_CFILE);

		if( str_replace('\\', '/', $file) !== $currentFile )
		{
			$file = $debug['file'];
			$line = $debug['line'];
		}

		$exceptionData = array
		(
			'message' => $msg,
			'file'	  => $file,
			'line'    => $line
		);

		if( $passed = $this->_argumentPassed($msg) )	
		{
			if( is_array($passed) )
			{
				$exceptionData = $passed;
			}
			else
			{
				return false;
			}
		}

		if( $missed = $this->_argumentMissed($msg) )
		{
			$exceptionData = $missed;
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
	
		echo $this->_template($msg, $file, $line, $no);  
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