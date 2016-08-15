<?php namespace ZN\Requirements;

trait LangTrait
{
    //--------------------------------------------------------------------------------------------------------
    // Lang                                                                       
    //--------------------------------------------------------------------------------------------------------
    //
    // @var lang                         
    //                                                                                           
    //--------------------------------------------------------------------------------------------------------
    protected $lang;

    //--------------------------------------------------------------------------------------------------------
    // lang()                                                                       
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $key
    // @param mixed  $options                                
    //                                                                                           
    //--------------------------------------------------------------------------------------------------------
    public function lang(String $key = NULL, $options = NULL)
    {
        if( ! defined('REQUIREMENT_LANG') )
        {
            $class     = str_replace(['ZN\\', STATIC_ACCESS], '', get_called_class());
            $classEx   = explode('\\', $class);
            $namespace = ! empty($classEx[0]) ? $classEx[0] : NULL;
            $class     = ! empty($classEx[1]) ? $classEx[1] : $namespace;
        
            if( $class !== $namespace )
            {
                if( stristr($key, ':') )
                {
                    $realKeys = $key;
                }
                else
                {
                    $realKeys = strtolower($class).':'.$key;
                }

                if( ! empty($options) )
                {
                    return lang($namespace, $realKeys, $options);
                }

                $this->lang = lang($namespace, $realKeys);
            }
            elseif( $class === $namespace )
            {  
                if( ! empty($options) )
                {
                    return lang($class, $key, $options);
                }

                $this->lang = lang($class, $key);
            }
        }
        else
        {
            $newKey = $key;
            $key    = NULL;   
        
            if( stristr($newKey, ':') )
            {
                $langEx  = explode(':',$newKey);

                if( ! empty($options) )
                {
                    return lang($langEx[0], $langEx[1].':'.$key, $options);
                }

                $getLang = lang($langEx[0]);

                if( ! empty($getLang) ) foreach( $getLang as $k => $l )
                {
                    $this->lang[str_replace($langEx[1].':', '', $k)] = $l;
                }    
            }
            else
            {
                $this->lang = lang($newKey);
            }
        }
    }
}

class_alias('ZN\Requirements\LangTrait', 'LangTrait');