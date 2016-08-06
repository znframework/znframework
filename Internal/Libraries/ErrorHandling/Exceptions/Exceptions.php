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

	//----------------------------------------------------------------------------------------------------
    // To String 
    //----------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //----------------------------------------------------------------------------------------------------	
	public function __toString()
	{
		return $this->_template($this->getMessage(), $this->getFile(), $this->getLine(), $this->getTrace());
	}

	//----------------------------------------------------------------------------------------------------
    // Throws
    //----------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $key
    // @param string $send
    //
    //----------------------------------------------------------------------------------------------------
	public function throws($message = NULL, $key = NULL, $send = NULL)
	{
		$debug = $this->_throwFinder(debug_backtrace());

		if( $lang = lang($message, $key, $send) )
		{
			$message = '['.$this->_cleanClassName($debug['class']).'::'.$debug['function'].'()] '.$lang;
		}

		$this->table('', $message, $debug['file'], $debug['line']);
	}

	//----------------------------------------------------------------------------------------------------
    // Table
    //----------------------------------------------------------------------------------------------------
    //
    // @param string $msg
    // @param string $file
    // @param string $line
    // @param string $no
    // @param array $trace
    //
    //----------------------------------------------------------------------------------------------------
	public function table($no = NULL, $msg = NULL, $file = NULL, $line = NULL, $trace = NULL)
	{
		$lang    = lang('Error');
		$message = $lang['line'].':'.$line.', '.$lang['file'].':'.$file.', '.$lang['message'].':'.$msg;
		
		report('GeneralError', $message, 'GeneralError');
	
		echo $this->_template($msg, $file, $line, $no, $trace);  
	}
	
	//----------------------------------------------------------------------------------------------------
    // Restore
    //----------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //----------------------------------------------------------------------------------------------------
	public function restore()
	{
		return restore_exception_handler();
	}
	
	//----------------------------------------------------------------------------------------------------
    // Handler
    //----------------------------------------------------------------------------------------------------
    //
    // @param callable $handler
    //
    //----------------------------------------------------------------------------------------------------
	public function handler($handler)
	{
		if( ! is_callable($handler) )
		{
			return $this->set(lang('Error', 'callableParameter', '1.(handler)'));	
		}

		return set_exception_handler($handler);
	}

	//----------------------------------------------------------------------------------------------------
    // Private Template
    //----------------------------------------------------------------------------------------------------
    //
    // @param string $msg
    // @param string $file
    // @param string $line
    // @param string $no
    // @param array $trace
    //
    //----------------------------------------------------------------------------------------------------
	private function _template($msg, $file, $line, $no, $trace)
	{
		$application = \Config::get('Application');

		if( ! $application['errorReporting'] )
		{
			return false;
		}
		
		if( in_array($no, $application['escapeErrors']) )
		{
			return false;
		}

		$exceptionData = array
		(
			'message' => '['.$msg.']',
			'file'	  => $file,
			'line'    => '['.$line.']'
		);

		if( $passed = $this->_argumentPassed($msg, $file, $line, $trace) )	
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

		if( $missed = $this->_argumentMissed($msg, $trace) )
		{
			$exceptionData = $missed;
		}

		$message = \Import::template('ExceptionTable', $exceptionData, true);

		return preg_replace('/\[(.*?)\]/', '<span style="color:#990000;">$1</span>', $message);
	}

	//----------------------------------------------------------------------------------------------------
    // Protected Clean Class Name
    //----------------------------------------------------------------------------------------------------
    //
    // @param string $class
    //
    //----------------------------------------------------------------------------------------------------
	protected function _cleanClassName($class)
	{
		return str_ireplace(STATIC_ACCESS, '', divide($class, '\\', -1));
	}

	//----------------------------------------------------------------------------------------------------
    // Protected Trace Finder
    //----------------------------------------------------------------------------------------------------
    //
    // @param array $trace
    //
    //----------------------------------------------------------------------------------------------------
	protected function _traceFinder($trace)
	{
		if
		(
			isset($trace[2]['class']) && 
			$this->_cleanClassName($trace[2]['class']) === 'StaticAccess' &&
			$trace[2]['function'] === '__callStatic'
		)
		{
			$traceInfo = $trace[2];

			$traceInfo['class']    = isset($trace[0]['class']) ? $trace[0]['class'] : $trace[2]['class'];
			$traceInfo['function'] = isset($trace[0]['function']) ? $trace[0]['function'] : $trace[2]['function'];
		}
		else
		{
			$traceInfo = $trace[0];
		}

		return 
		[
			'class'    => $this->_cleanClassName($traceInfo['class']),
			'function' => $traceInfo['function'],
			'file'	   => $traceInfo['file'],
			'line'	   => $traceInfo['line']
		];
	}

	//----------------------------------------------------------------------------------------------------
    // Protected Throw Finder
    //----------------------------------------------------------------------------------------------------
    //
    // @param array $trace
    //
    //----------------------------------------------------------------------------------------------------
	protected function _throwFinder($trace)
	{
		$classInfo = $trace[3];
		$fileInfo  = $trace[5];

		return 
		[
			'class'    => $this->_cleanClassName($classInfo['class']),
			'function' => $classInfo['function'],
			'file'	   => $fileInfo['file'],
			'line'	   => $fileInfo['line']
		];
	}

	//----------------------------------------------------------------------------------------------------
    // Protected Argument Missed
    //----------------------------------------------------------------------------------------------------
    //
    // @param string $msg
    //
    //----------------------------------------------------------------------------------------------------
	protected function _argumentMissed($msg, $trace)
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
		
		$traceInfo       = $this->_traceFinder($trace);
		
		$langMessage1    = '['.$this->_cleanClassName($traceInfo['class']).'::'.
		                   $traceInfo['function '].'()] p'.$argument.':';

		$exceptionData   = array
		(
			'message' => lang('Error', 'emptyParameter', $langMessage1),
			'file'	  => $traceInfo['file'],
			'line'    => '['.$traceInfo['line'].']'
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
	protected function _argumentPassed($msg, $file, $line, $trace)
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

		$traceInfo = $this->_traceFinder($trace);

		//output($trace);

		if( $type !== $data )
		{
			$langMessage1 = '['.$this->_cleanClassName($class).'::'.$method.'] p'.$argument.':';
			$langMessage2 = '[`'.$type.'`]';

			$exceptionData = array
			(
				'message' => lang('Error', 'typeHint', ['&' => $langMessage1, '%' => $langMessage2]),
				'file'	  => $traceInfo['file'],
				'line'    => '['.$traceInfo['line'].']',
			);

			return $exceptionData;
		}

		return true;
	}
}