<?php namespace ZN\Generator;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Singleton;

class DatabaseDefinitions
{
    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $this->db    = Singleton::class('ZN\Database\DB');
        $this->tool  = Singleton::class('ZN\Database\DBTool');
        $this->forge = Singleton::class('ZN\Database\DBForge');    
    }
}
