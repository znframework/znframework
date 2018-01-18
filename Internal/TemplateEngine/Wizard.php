<?php namespace ZN\TemplateEngine;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Wizard as Wiz;

class Wizard
{
    /**
     * Get config
     * 
     * @var array
     */
    protected static $config;

    /**
     * PHP tag isolation
     * 
     * @param string $data
     * 
     * @return void
     */
	public static function isolation(String $data = '')
	{
		Wiz::isolation($data);
	}

    /**
     * Get data.
     * 
     * @param string $string
     * @param array  $data = []
     * 
     * @return string
     */
    public static function data(String $string, Array $data = []) : String
    {
        return Wiz::data
        (
            $string, 
            $data, 
            Config::default(new TemplateEngineDefaultConfiguration)::get('ViewObjects', 'wizard')
        );
    }
}
