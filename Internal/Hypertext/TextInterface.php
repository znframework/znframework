<?php namespace ZN\Hypertext;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface TextInterface
{
    /**
     * Sets the [type] property of the [script] tag.
     * 
     * @param string $type
     * 
     * @return $this
     */
    public function type(String $type);

    /**
     * Imports script libraries.
     * 
     * @param string ...$libraries
     * 
     * @return $this
     */
    public function library(...$libraries);

    /**
     * Opens the [script] tag.
     * 
     * @param void
     * 
     * @return string
     */
    public function open() : String;

    /**
     * Closes the [/script] tag.
     * 
     * @param void
     * 
     * @return string
     */
    public function close() : String;
}
