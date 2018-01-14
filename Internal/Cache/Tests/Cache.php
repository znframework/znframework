<?php namespace ZN\Cache\Tests;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controller\UnitTest;

class Cache extends UnitTest
{
    /**
     * Unit test settings
     * 
     * @param string class
     * @param array  methods
     */
    const unit =
    [
        'class'   => 'Cache',
        'methods' => 
        [
            'data'          => [['send' => 'Data']],
            'key'           => ['key'],
            'file'          => ['example.txt'],
            'insert'        => ['key', 'Data', 90],
            'select'        => ['key'],
            'increment'     => ['key', 2],
            'increment'     => ['key', 1],
            'info'          => [NULL],
            'getMetaData'   => ['key'],
            'delete'        => ['key']
        ]
    ];
}
