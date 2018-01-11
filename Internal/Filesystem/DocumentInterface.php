<?php namespace ZN\Filesystem\Document;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface DocumentInterface
{
    /**
     * Target File
     * 
     * @param string $target
     * 
     * @return Document
     */
    public function target(String $target) : Document;

    /**
     * Apply changes
     * 
     * @return mixed
     */
    public function apply();
}