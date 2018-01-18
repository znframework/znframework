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

use ZN\Buffering;

class FileBuffering
{
    /**
     * File Buffering
     * 
     * @param string $file
     * @param array  $data = []
     * 
     * @return string
     */
	public static function file(String $file, Array $data = []) : String
	{
		return Buffering::file($file, $data);
	}
}
