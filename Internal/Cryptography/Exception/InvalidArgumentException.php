<?php namespace ZN\Cryptography\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class InvalidArgumentException extends \Exception
{
    const lang = 
    [
        'en' => '`String $type` parameter should contain the hash algos(md5, sha1) data type!',
        'tr' => '`String $type` parametresi şifreleme algoritmalarıdan(md5, sha1) birini içermelidir!'
    ];
}
