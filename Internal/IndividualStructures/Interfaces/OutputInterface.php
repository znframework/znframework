<?php namespace ZN\IndividualStructures;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

interface OutputInterface
{
    //--------------------------------------------------------------------------------------------------
    // write()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param array  $vars = []
    //
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    public function write($data = NULL, Array $vars = NULL);

    //--------------------------------------------------------------------------------------------------
    // writeLine()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $data
    // @param array  $vars    = []
    // @param int    $brCount = 1
    //
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    public function writeLine($data = NULL, Array $vars = NULL, Int $brCount = 1);

    //--------------------------------------------------------------------------------------------------
    // display()
    //--------------------------------------------------------------------------------------------------
    //
    // @param mixed $data
    // @param array $settings = []
    // @param bool  $content  = false
    //
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    public function display($data, Array $settings = NULL, Bool $content = false);
}
