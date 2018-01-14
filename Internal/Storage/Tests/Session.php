<?php namespace ZN\Storage\Tests;
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

class Session extends UnitTest
{
    /**
     * Unit test settings
     * 
     * @param string class
     * @param array  methods
     */
    const unit =
    [
        'class'   => 'ZN\Storage\Session',
        'methods' => 
        [
            'insert'    => ['key', 'value'],
            'select'    => ['key'],
            'selectAll' => ['key'],
            'delete'    => ['key'],
            'deleteAll' => []
        ]
    ];
}
