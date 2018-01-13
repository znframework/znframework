<?php namespace ZN\Commands;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class TerminalCommand
{
    /**
     * Magic constructor
     * 
     * @param string $realCommands
     * 
     * @return void
     */
    public function __construct($realCommands)
    {   
        exec($realCommands, $response); 
        
        new Result($response);
    }
}