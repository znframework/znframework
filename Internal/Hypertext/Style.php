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

use ZN\Inclusion;

class Style implements TextInterface
{
    /**
     * type
     * 
     * @var string
     */
    protected $type = 'text/css';

    /**
     * Sets the [type] property of the [script] tag.
     * 
     * @param string $type
     * 
     * @return $this
     */
    public function type(String $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Imports script libraries.
     * 
     * @param string ...$libraries
     * 
     * @return $this
     */
    public function library(...$libraries)
    {
        Inclusion\Style::use(...$libraries);

        return $this;
    }

     /**
     * Opens the [script] tag.
     * 
     * @param void
     * 
     * @return string
     */
    public function open() : String
    {
        $script = "<style type=\"$this->type\">".EOL;

        return $script;
    }

    /**
     * Closes the [/script] tag.
     * 
     * @param void
     * 
     * @return string
     */
    public function close() : String
    {
        $script =  '</style>'.EOL;
        return $script;
    }
}
