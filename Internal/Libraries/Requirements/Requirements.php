<?php namespace ZN;

class Requirements extends CallController implements RequirementsInterface
{
	//----------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Config                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// @var array      		     		 
	//          																				 
	//----------------------------------------------------------------------------------------------------
	protected $config = [];

	//----------------------------------------------------------------------------------------------------
	// Error                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// @var string      		     		 
	//          																				 
	//----------------------------------------------------------------------------------------------------
	protected $error;
	
	//----------------------------------------------------------------------------------------------------
	// Success
	//----------------------------------------------------------------------------------------------------
	//
	// @var  string
	//
	//----------------------------------------------------------------------------------------------------
	protected $success;

	//----------------------------------------------------------------------------------------------------
	// Construct
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct(Array $config = NULL, String $path = NULL)
	{
		$this->config($config, $path);
	}

	//----------------------------------------------------------------------------------------------------
	// config()                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// @param  array  $settings: empty
	// @param  string $path    : empty
	// @return object 	        		     		 
	//          																				 
	//----------------------------------------------------------------------------------------------------
	public function config(Array $settings = NULL, String $path = NULL)
	{
		// Yol parametre olarak belirtilirse bu veri kullan.
		if( ! empty( $path) )
		{
			$getConfigName = $path;	
		}
		else
		{
			$getConfigName = defined('static::config') ? static::config : NULL;	
		}
		
		// İsim bilgisi tanımlanmamışsa ön tanımlı olarak 
		// Sınıf ismini dosya ve ayar ismi olarak kullan.
		if( empty($getConfigName) )
		{
			$file = divide(str_replace(STATIC_ACCESS, '', get_called_class()), '\\', -1); 
			
			if( ! empty($settings) )
			{
				\Config::set($file, $settings);
			}
			
			$this->config = \Config::get($file);
		}
		else
		{
			// Gelen ayar dosyası bilgini ayrıştırır.
			$configName = explode(':', $getConfigName);
			
			$file   = ! empty($configName[0]) ? $configName[0] : '';
			$config = ! empty($configName[1]) ? $configName[1] : ''; 
			
			// Ayarları yapılandır.
			if( ! empty($settings) )
			{
				if( ! empty($config) )
				{
					\Config::set($file, $config, $settings);
				}
				else
				{
					\Config::set($file, $settings);	
				}
			}
			
			// Yapılandırılmış ayar dosyasının yeni değerleri aktar.
			$this->config = \Config::get($file, $config);
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// error()                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// @param void	        		     		 
	//          																				 
	//----------------------------------------------------------------------------------------------------
	public function error()
	{
		if( ! empty($this->error) ) 
		{
			if( is_array($this->error) )
			{
				return implode('<br>', $this->error);
			}

			return $this->error;
		}
		else 
		{
			return false;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// success()                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// @param void	        		     		 
	//          																				 
	//----------------------------------------------------------------------------------------------------
	public function success()
	{
		if( empty($this->error) ) 
		{
			if( ! empty($this->success) )
			{
				if( is_array($this->success) )
				{
					return implode('<br>', $this->success);
				}

				return $this->success;
			}
			else
			{
				return lang('Success', 'success');
			}
		}
		else 
		{
			return false;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Status
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function status()
	{
		if( $success = $this->success() ) 
		{
			return $success;
		}

		return $this->error();
	}
}

class_alias('ZN\Requirements', 'Requirements');