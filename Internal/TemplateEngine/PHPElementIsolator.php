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

use ZN\Wizard;

class PHPElementIsolator
{
    /**
     * PHP tag isolation
     * 
     * @param string $data
     * 
     * @return void
     */
	public static function file(String $file)
	{
		Wizard::isolation($file);
	}
}
