<?php namespace ZN\ViewObjects\Abstracts;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use CLController;

abstract class GridAbstract extends CLController
{
    /**
     * Creates a grid.
     * 
     * @param void
     * 
     * @return string
     */
    abstract public function create() : String;

    /**
     * Sets the limit of the displayed data.
     * 
     * @param int $limit
     * 
     * @return $this
     */
    abstract public function limit(Int $limit);
}
