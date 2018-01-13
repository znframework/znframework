<?php namespace ZN\ViewObjects;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class CDN implements CDNInterface
{
    /**
     * Get cdn data.
     * 
     * @param string $configName
     * @param string $name
     * 
     * @return string
     */
    public static function get(String $configName, String $name) : String
    {
        $config = \Config::get('CDNLinks');

        $configData = ! empty($config[$configName]) ? $config[$configName] : '';

        if( empty($configData) )
        {
            return false;
        }

        $data = array_change_key_case($configData);
        $name = strtolower($name);

        if( isset($data[$name]) )
        {
            return $data[$name];
        }
        else
        {
            return $data;
        }
    }

    /**
     * Get value.
     * 
     * @param string $name
     * 
     * @return string
     */
    public static function image(String $name) : String
    {
        return self::get('images', $name);
    }

    /**
     * Get value.
     * 
     * @param string $name
     * 
     * @return string
     */
    public static function style(String $name) : String
    {
        return self::get('styles', $name);
    }

    /**
     * Get value.
     * 
     * @param string $name
     * 
     * @return string
     */
    public static function script(String $name) : String
    {
        return self::get('scripts', $name);
    }

    /**
     * Get value.
     * 
     * @param string $name
     * 
     * @return string
     */
    public static function font(String $name) : String
    {
        return self::get('fonts', $name);
    }

   /**
     * Get value.
     * 
     * @param string $name
     * 
     * @return string
     */
    public static function file(String $name) : String
    {
        return self::get('files', $name);
    }
}
