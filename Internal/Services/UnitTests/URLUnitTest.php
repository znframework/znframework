<?php namespace ZN\Services;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class URLUnitTest extends \UnitTestController
{
    const unit =
    [
        'class'   => 'URL',
        'methods' => 
        [
            'base'           => [],
            'base:2'         => ['test'],
            'site'           => [],
            'site:2'         => ['test'],
            'sites'          => [],
            'current'        => [],
            'current:2'      => ['test'],
            'host'           => [],
            'host:2'         => ['test']
        ]
    ];
}
