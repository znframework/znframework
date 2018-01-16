<?php namespace ZN\Authorization;
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
class AuthorizationDefaultConfiguration
{
    /*
    |--------------------------------------------------------------------------
    | Permission
    |--------------------------------------------------------------------------
    |
    | Includes configurations for the Permission library.
    | 
    | method : It is used to set which id value will use which method of sending.
    | page   : It is used to set which id value will use which page.
    | process: It is used to set which id value will use which object.
    |
    | Example Usage
    |
    | [
    |     '1' => 'any',
    |     '2' => ['noperm'  => ['delete', 'update']],
    |     '3' => ['perm'    => ['delete', 'update']],
    |     '4' => ['noperm'  => ['delete', 'update', 'add']],
    |     '5' => 'all'
    | ]
    |
    */

    public $method  = [];
    public $page    = [];
    public $process = [];
}
