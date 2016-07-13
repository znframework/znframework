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
	* SET            	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Kütüphaneler içinde oluşan hataları kaydetmek için kullanılır.          |
	|          																				  |
	******************************************************************************************/	
	public function set($errorMessage = '', $output = false, $object = '')
	{
		//------------------------------------------------------------------------------------------------
		// 2. Parametre metinsel değer alırsa lang() yönteminden verinin çağrılmasını sağlar.
		//------------------------------------------------------------------------------------------------
		if( isChar($output) )
		{
			$errorMessage = lang($errorMessage, $output, $object);	
		}
		
		$info = debug_backtrace();
	
		$className = isset($info[1]['class'])
				   ? str_ireplace(STATIC_ACCESS, '', $info[1]['class'])
				   : ( isset($info[5]['class']) ? $info[5]['class'] : false );
		   
		$methodName = isset($info[1]['function'])
					? $info[1]['function']
					: ( isset($info[5]['function']) ? $info[5]['function'] : false );
					
		$line = isset($info[1]['line'])
			  ? $info[1]['line']
			  : ( isset($info[5]['line']) ? $info[5]['line'] : false );
			  
		$file = isset($info[1]['file'])
			  ? $info[1]['file']
			  : ( isset($info[5]['file']) ? $info[5]['file'] : false );
	
		$this->errors[strtolower($className)][strtolower($methodName)]['message'][] = $errorMessage;
		$this->errors[strtolower($className)][strtolower($methodName)]['line'][]    = $line; 
		$this->errors[strtolower($className)][strtolower($methodName)]['file'][]    = $file; 
		
		report(ucfirst($className.'Error'), $errorMessage, ucfirst($className).'Library');
	
		return $output === true ? $errorMessage : false;
	}
	
	/******************************************************************************************
	* GET ARRAY     	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Sınıfların kullanımında oluşmuş hatalarını dizi tipinde döndürür.       |
	|          																				  |
	******************************************************************************************/	
	public function getArray($className = '', $methodName = '')
	{
		$className  = strtolower($className);
		$methodName = strtolower($methodName);
	
		if( isset($this->errors[$className]) )
		{
			if( isset($this->errors[$className][$methodName]['message']) )
			{
				return $this->errors[$className][$methodName]['message']; 
			}
			else
			{
				return $this->errors[$className];	
			}
		}
		else
		{
			if( ! empty($this->errors) )
			{
				return $this->errors;	
			}
			else
			{
				return false;	
			}
		}
	}
	
	/******************************************************************************************
	* GET STRING     	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Sınıfların kullanımında oluşmuş hatalarını metinsel tipinde döndürür.   |
	|          																				  |
	******************************************************************************************/	
	public function getString($className = '', $methodName = '')
	{
		$className  = strtolower($className);
		$methodName = strtolower($methodName);

		if( isset($this->errors[$className]) )
		{
			$string = '';
			
			if( isset($this->errors[$className][$methodName]['message']) )
			{
				foreach( $this->errors[$className][$methodName]['message'] as $error )
				{
					$string .= ucfirst($className)."::".$methodName." : $error<br>";
				} 
				
				return $string;
			}
			else
			{
				foreach( $this->errors[$className] as $key => $error )
				{	
					if( isset($this->errors[$className][$key]['message']) ) foreach( $this->errors[$className][$key]['message'] as $v )
					{
						$string .= ucfirst($className)."::".$key." : $v<br>";	
					}
				}	
				
				return $string;
			}
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* PUBLIC GET TEMPLATE                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Sınıfların kullanımında oluşmuş hatalarını metinsel tipinde döndürür.   |
	|          																				  |
	******************************************************************************************/	
	public function getTable($className = '', $methodName = '')
	{
		$data = array
		(
			'errors'	 => $this->errors,
			'className'  => strtolower($className),
			'methodName' => strtolower($methodName),
		);
		
		return \Import::template('ErrorTable', $data, true);
	}
	
	/******************************************************************************************
	* GET           	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Oluşmuş hatalarını metinsel veya dizi tipinde döndürür.   			  |
	|          																				  |
	******************************************************************************************/	
	public function get($className = '', $methodName = '', $type = 'string')
	{
		if( strtolower($type) === 'table')
		{
			return $this->getTable($className, $methodName);
		}
		elseif( strtolower($type) === 'string')
		{
			return $this->getString($className, $methodName);
		}
		else
		{
			return $this->getArray($className, $methodName);
		}	
	}
	
	/******************************************************************************************
	* MESSAGE	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: getErrorMessage() yönteminin aynısıdır.  								  |
	|															                              |
	******************************************************************************************/	
	public function message($langFile = '', $errorMsg = '', $ex = '')
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