<?php
namespace ZN\ErrorHandling;

use ZN\VariableTypes\InternalArrays;

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

    //----------------------------------------------------------------------------------------------------
    // Protected Type Hints
    //----------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //----------------------------------------------------------------------------------------------------
    protected $typeHints =
    [
        'int'       => 'is_int',
        'integer'   => 'is_int',
        'string'    => 'is_string',
        'numeric'   => 'is_numeric',
        'array'     => 'is_array',
        'object'    => 'is_object',
        'resource'  => 'is_resource',
        'callable'  => 'is_callable',
        'file'      => 'is_file',
        'dir'       => 'is_dir',
        'boolean'   => 'is_bool',
        'bool'      => 'is_bool',
        'email'     => 'isEmail',
        'hash'      => 'isHash',
        'charset'   => 'isCharset',
        'scalar'    => 'is_scalar',
        'value'     => 'isValue'
    ];

    //----------------------------------------------------------------------------------------------------
    // Protected Debug Back Trace
    //----------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //----------------------------------------------------------------------------------------------------
    protected function _debugBackTrace()
    {
    	$objectNumber  = 5;
    	$fileNumber    = 7;
    	$defaultNumber = 5;

    	$info       = debug_backtrace();
        $className  = isset($info[$objectNumber]['class']) 
                    ? str_ireplace(STATIC_ACCESS, '', $info[$objectNumber]['class']) 
        			: ( isset($info[$defaultNumber]['class']) ? $info[$defaultNumber]['class'] : false );
        $methodName = isset($info[$objectNumber]['function']) 
                    ? $info[$objectNumber]['function'] 
                    : ( isset($info[$objectNumber]['function']) ? $info[$defaultNumber]['function'] : false );
        $line       = isset($info[$fileNumber]['line']) 
                    ? $info[$fileNumber]['line'] 
                    : ( isset($info[$defaultNumber]['line']) ? $info[$defaultNumber]['line'] : false );
        $file       = isset($info[$fileNumber]['file']) 
                    ? $info[$fileNumber]['file'] 
                    : ( isset($info[$defaultNumber]['file']) ? $info[$defaultNumber]['file'] : false );

        return 
        [
        	'className'  => $className,
        	'methodName' => $methodName,
        	'line'		 => $line,
        	'file'	     => $file
        ];
    }

    //----------------------------------------------------------------------------------------------------
    // Type Hint
    //----------------------------------------------------------------------------------------------------
    //
    // @param array ...$parameters: empty
    //
    //----------------------------------------------------------------------------------------------------
    public function typeHint($parameters = [])
    {
        $errors     = '';
        $funcParams = '';
        $info       = $this->_debugBackTrace();

        $className  = $info['className'];
        $methodName = $info['methodName'];
        $line       = $info['line'];
        $file       = $info['file'];

        if( strstr($className, '\\') )
        {
            $className  = divide($className, '\\', -1);
        }

        $index = 1;

        foreach( $parameters as $type => $var )
        {
            $key         = '$p'.($index);
            $funcParams .= ( ! is_numeric($type) ? $type : 'mixed').' '.$key.", ";

            if( ! empty($this->typeHints[$type]) )
            {
                $is = $this->typeHints[$type];

                if( ! $is($var) )
                {
                    $errors .= '&nbsp;&nbsp;'.lang('Error', 'typeHint', ['&' => $key.':', '%' => '`'.$type.'`']).\Html::br();
                }
            }

            $index++;
        }

        if( ! empty($errors) )
        {
            $errors = $className."::".$methodName."(".rtrim($funcParams, ", ").")".\Html::br().$errors;
            exit(\Exceptions::table('', $errors, $file, $line));
        }
    }

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
		
		$info       = $this->_debugBackTrace();

        $className  = $info['className'];
        $methodName = $info['methodName'];
        $line       = $info['line'];
        $file       = $info['file'];

        if( strstr($className, '\\') )
        {
            $className  = divide($className, '\\', -1);
        }

        $className  = strtolower($className);
        $methodName = strtolower($methodName);

		$this->errors[$className][$methodName]['message'][] = $errorMessage;
		$this->errors[$className][$methodName]['line'][]    = $line;
		$this->errors[$className][$methodName]['file'][]    = $file;

        $className = ucfirst($className);
		report($className.'Error', $errorMessage, $className.'Library');
	
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

        if( empty($className) )
        {
            return $this->errors;
        }

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