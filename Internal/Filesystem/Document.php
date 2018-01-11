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

use ZN\Filesystem\Exception\FileNotFoundException;

class Document implements DocumentInterface
{
    /**
     * Magic Call
     * 
     * @param string $method
     * @param string $parameters
     * 
     * @return $this
     */
    public function __call($method, $parameters)
    {
        if( substr($this->target, -1) === '/' )
        {
            $type = 'Folder';
        }
        else
        {
            $type = 'File';
        }

        $this->apply = $type::$method($this->target, ...$parameters);

        return $this;
    }
 
    /**
     * Target File
     * 
     * @param string $target
     * 
     * @return Document
     */
    public function target(String $target) : Document
    {
        $this->target = $target;
        
        return $this;
    }   

    /**
     * Apply changes
     * 
     * @return mixed
     */
    public function apply()
    {
        return $this->apply ?? false;
    }
}