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

/**
 * Default Cookie Configuration
 * 
 * Enabled when the configuration file can not be accessed.
 */
class TemplateEngineDefaultConfiguration
{
    /*
    |--------------------------------------------------------------------------
    | Wizard
    |--------------------------------------------------------------------------
    |
    | The template wizard specifies what to compile.
    |
    */

    public $keywords  = true;
    public $printable = true;
    public $functions = true;
    public $comments  = true;
    public $tags      = true;
    public $jsdata    = true;
    public $html      = false;
}
