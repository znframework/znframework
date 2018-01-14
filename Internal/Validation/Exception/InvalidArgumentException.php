<?php namespace ZN\Validation\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Exception;

class InvalidArgumentException extends Exception
{
    const lang = 
    [
        'en' => '% parameter may contain one of the options [post, get, request or data]!',
        'tr' => '% parametre [post, get, request veya data] seçeneklerinden birini içerebilir!'
    ];
}
