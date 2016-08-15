<?php namespace ZN\Requirements;

trait ConfigTrait
{
    //--------------------------------------------------------------------------------------------------------
    // Config                                                                       
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array                        
    //                                                                                           
    //--------------------------------------------------------------------------------------------------------
    protected $config = [];

    //--------------------------------------------------------------------------------------------------------
    // config()                                                                       
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  array  $settings: empty                   
    //                                                                                           
    //--------------------------------------------------------------------------------------------------------
    public function config($settings = NULL)
    {
        if( defined('REQUIREMENT_CONFIG') )
        {
            $getConfigName = REQUIREMENT_CONFIG;
        }
        else
        {
            $getConfigName = NULL;
        } 

        if( empty($getConfigName) )
        {
            $file = divide(str_replace(STATIC_ACCESS, '', get_called_class()), '\\', -1);; 
            
            if( ! empty($settings) )
            {
                \Config::set($file, $settings);
            }
            
            $this->config = \Config::get($file);
        }
        else
        {
            $configName = explode(':', $getConfigName);
            
            $file   = ! empty($configName[0]) ? $configName[0] : '';
            $config = ! empty($configName[1]) ? $configName[1] : ''; 
            
            if( isArray($settings) )
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
            
            $this->config = \Config::get($file, $config);
        }
        
        return $this;
    }
}

class_alias('ZN\Requirements\ConfigTrait', 'ConfigTrait');