<?php
namespace ZN\Foundations\Traits;

trait ConfigMethodTrait
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
	// Protected $config                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// @var array      		     		 
	//          																				 
	//----------------------------------------------------------------------------------------------------
	protected $config = [];
	
	//----------------------------------------------------------------------------------------------------
	// config()                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// @param  array  $settings: empty
	// @param  string $path    : empty
	// @return object 	        		     		 
	//          																				 
	//----------------------------------------------------------------------------------------------------
	public function config($settings = [], $path = '')
	{
		// Yol parametre olarak belirtilirse bu veri kullan.
		if( ! empty( $path) )
		{
			$getConfigName = $path;	
		}
		else
		{
			$getConfigName = defined('self::CONFIG_NAME') ? self::CONFIG_NAME : NULL;	
		}
		
		// İsim bilgisi tanımlanmamışsa ön tanımlı olarak 
		// Sınıf ismini dosya ve ayar ismi olarak kullan.
		if( empty($getConfigName) )
		{
			$file = divide(str_replace(STATIC_ACCESS, '', __CLASS__), '\\', -1); 
			
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
}