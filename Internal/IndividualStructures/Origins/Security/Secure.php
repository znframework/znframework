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

class Secure
{
    use \SerializationAbility;
    
    const serialization = 
    [
        'class' => 'Security',
        'start' => 'data',
        'end'   => 'get'
    ];
}
