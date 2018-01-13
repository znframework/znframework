<?php namespace ZN\Storage;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface SessionInterface
{
    /**
     * Insert session
     * 
     * @param string $name
     * @param mixed  $value
     * 
     * @return bool
     */
    public function insert(String $name, $value) : Bool;

    /**
     * Select session
     * 
     * @param string $name
     * 
     * @return mixed
     */
    public function select(String $name);

    /**
     * Delete session
     * 
     * @param string $name
     * 
     * @return bool
     */
    public function delete(String $name) : Bool;

    /**
     * Select all session
     * 
     * @param void
     * 
     * @return array
     */
    public function selectAll() : Array;

    /**
     * Delete all session
     * 
     * @param void
     * 
     * @return void
     */
    public function deleteAll() : Bool;

    /**
     * Session start
     * 
     * @param void
     * 
     * @return void
     */
    public static function start();
}
