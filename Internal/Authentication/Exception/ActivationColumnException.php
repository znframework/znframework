<?php namespace ZN\Authentication\Exception;
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

class ActivationColumnException extends Exception
{
    const lang = 
    [
        'tr' => 'Aktivasyon kolonu ayarlı değil!', 
        'en' => 'Activation column not set!'
    ];
}
