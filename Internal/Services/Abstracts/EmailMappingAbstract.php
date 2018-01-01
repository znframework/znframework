<?php namespace ZN\Services\Abstracts;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

abstract class EmailMappingAbstract
{
    //--------------------------------------------------------------------------------------------------------
    // Send
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $to
    // @param string $subject
    // @param string $message
    // @param mixed  $headers
    // @param mixed  $settings
    //
    //--------------------------------------------------------------------------------------------------------
    abstract public function send($to, $subject, $message, $headers, $settings);
}