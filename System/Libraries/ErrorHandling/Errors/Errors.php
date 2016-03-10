<?php
class Errors implements ErrorsInterface
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
	private static $errors;
	
	/******************************************************************************************
	* SET            	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Kütüphaneler içinde oluşan hataları kaydetmek için kullanılır.          |
	|          																				  |
	******************************************************************************************/	
	public static function set($errorMessage = '', $output = false, $object = '')
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
	
		self::$errors[strtolower($className)][strtolower($methodName)]['message'][] = $errorMessage;
		self::$errors[strtolower($className)][strtolower($methodName)]['line'][]    = $line; 
		self::$errors[strtolower($className)][strtolower($methodName)]['file'][]    = $file; 
		
		report(ucfirst($className.'Error'), $errorMessage, ucfirst($className).'Library');
	
		return $output === true ? $errorMessage : false;
	}
	
	/******************************************************************************************
	* GET ARRAY     	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Sınıfların kullanımında oluşmuş hatalarını dizi tipinde döndürür.       |
	|          																				  |
	******************************************************************************************/	
	public static function getArray($className = '', $methodName = '')
	{
		$className  = strtolower($className);
		$methodName = strtolower($methodName);
	
		if( isset(self::$errors[$className]) )
		{
			if( isset(self::$errors[$className][$methodName]['message']) )
			{
				return self::$errors[$className][$methodName]['message']; 
			}
			else
			{
				return self::$errors[$className];	
			}
		}
		else
		{
			if( ! empty(self::$errors) )
			{
				return self::$errors;	
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
	public static function getString($className = '', $methodName = '')
	{
		$className  = strtolower($className);
		$methodName = strtolower($methodName);

		if( isset(self::$errors[$className]) )
		{
			$string = '';
			
			if( isset(self::$errors[$className][$methodName]['message']) )
			{
				foreach( self::$errors[$className][$methodName]['message'] as $error )
				{
					$string .= ucfirst($className)."::".$methodName." : $error<br>";
				} 
				
				return $string;
			}
			else
			{
				foreach( self::$errors[$className] as $key => $error )
				{	
					if( isset(self::$errors[$className][$key]['message']) ) foreach( self::$errors[$className][$key]['message'] as $v )
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
	public static function getTable($className = '', $methodName = '')
	{
		$data = array
		(
			'errors'	 => self::$errors,
			'className'  => strtolower($className),
			'methodName' => strtolower($methodName),
		);
		
		return Import::template('ErrorTable', $data, true);
	}
	
	/******************************************************************************************
	* GET           	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Oluşmuş hatalarını metinsel veya dizi tipinde döndürür.   			  |
	|          																				  |
	******************************************************************************************/	
	public static function get($className = '', $methodName = '', $type = 'string')
	{
		if( strtolower($type) === 'table')
		{
			return self::getTable($className, $methodName);
		}
		elseif( strtolower($type) === 'string')
		{
			return self::getString($className, $methodName);
		}
		else
		{
			return self::getArray($className, $methodName);
		}	
	}
	
	/******************************************************************************************
	* MESSAGE	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: getErrorMessage() yönteminin aynısıdır.  								  |
	|															                              |
	******************************************************************************************/	
	public static function message($langFile = '', $errorMsg = '', $ex = '')
	{
		return getErrorMessage($langFile, $errorMsg, $ex);
	}
	
	/******************************************************************************************
	* LAST		                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Son oluşan hata hakkında bilgi verir.						   			  |
	|          																				  |
	******************************************************************************************/	
	public static function last($type = NULL)
	{
		return errorReport($type);
	}
	
	/******************************************************************************************
	* LOG	           	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir yerlere bir hata iletisi gönderir.					   			  |
	|          																				  |
	******************************************************************************************/	
	public static function log($message = '', $type = 0, $destination = '', $header = '')
	{
		if( ! is_string($message) || ! is_string($destination) )
		{
			return self::set(lang('Error', 'stringParameter', '1.(message) & 3.(destination)'));	
		}
		
		if( ! is_numeric($type) )
		{
			return self::set(lang('Error', 'numericParameter', '2.(type)'));	
		}
		
		return error_log($message, $type, $destination, $header);
	}
	
	/******************************************************************************************
	* REPORT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Hangi PHP hatalarının raporlanacağını tanımlar.					      |
	|          																				  |
	******************************************************************************************/	
	public static function report($level = 0)
	{
		if( ! is_numeric($level) )
		{
			return self::set(lang('Error', 'numericParameter', '1.(level)'));	
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
	public static function handler($handler = 0, $errorTypes = 0)
	{
		if( ! is_callable($handler) )
		{
			return self::set(lang('Error', 'callableParameter', '1.(handler)'));	
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
	public static function trigger($msg = '', $errorType = E_USER_NOTICE)
	{
		if( ! is_string($msg) )
		{
			return self::set(lang('Error', 'stringParameter', '1.(msg)'));	
		}

		return trigger_error ($msg, $errorType);
	}
	
	/******************************************************************************************
	* RESTORE HANDLER                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Bir önceki hata eylemcisini devreye sokar.			   				  |
	|          																				  |
	******************************************************************************************/	
	public static function restore()
	{
		return restore_error_handler();
	}
}