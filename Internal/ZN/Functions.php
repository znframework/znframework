<?php
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

/**
 * CSRFInput
 * 
 * Generates a 32-character random key. And it transfers it to the form hidden object.
 * 
 * @param void
 * 
 * @return string
 * 
 */
function CSRFInput()
{
    ZN\Security::createCSRFTokenKey();

    return Form::hidden('token', ZN\Security::getCSRFTokenKey());
}

/**
 * output
 * 
 * Produces formatted output.
 * 
 * @param mixed $data
 * @param array $settings = NULL
 * @param bool  $content  = false
 * 
 * @return mixed
 */
function output($data, Array $settings = NULL, Bool $content = false)
{
    return ZN\Output::display($data, $settings, $content);
}

/**
 * redirect
 * 
 * Routes to the specified URI or URL.
 * 
 * @param string $url  = NULL
 * @param int    $time = 0
 * @param array  $data = NULL
 * @param bool   $exit = true
 * 
 * @return void
 */
function redirect(String $url = NULL, Int $time = 0, Array $data = NULL, Bool $exit = true)
{
    new Redirect($url, $time, $data, $exit);
}
