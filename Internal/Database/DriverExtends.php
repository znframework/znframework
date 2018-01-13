<?php namespace ZN\Database;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use DB;

class DriverExtends
{
    protected $differentConnection;
    protected $settings;

    public function __construct($settings = [])
    {
        $this->settings = $settings;
        $this->differentConnection = DB::differentConnection($settings);
    }
}
