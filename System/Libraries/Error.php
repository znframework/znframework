<?php
class Error
{
	/***********************************************************************************/
	/* ERROR LIBRARY	         			                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Error
	/* Versiyon: 2.0 Temmuz V042
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: error::, $this->error, zn::$use->error, uselib('error')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
	public static function set($errorMessage = '')
	{
		$info = debug_backtrace();
	
		$className = isset($info[1]['class'])
				   ? str_ireplace(STATIC_ACCESS, '', $info[1]['class'])
				   : $info[5]['class'];
		   
		$methodName = isset($info[1]['function'])
					? $info[1]['function']
					: $info[5]['function'];
					
		$line = isset($info[1]['line'])
			  ? $info[1]['line']
			  : $info[5]['line'];
			  
		$file = isset($info[1]['file'])
			  ? $info[1]['file']
			  : $info[5]['file'];
	
		self::$errors[strtolower($className)][strtolower($methodName)]['message'][] = $errorMessage;
		self::$errors[strtolower($className)][strtolower($methodName)]['line'][]    = $line; 
		self::$errors[strtolower($className)][strtolower($methodName)]['file'][]    = $file; 
		
		report(ucfirst($className.'Error'), $errorMessage, ucfirst($className).'Library');
		
		return false;
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
}