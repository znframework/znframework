<?php namespace ZN\DateTime;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class DateUnitTest extends \UnitTestController
{
    const unit =
    [
        'class'   => 'Date',
        'methods' =>
        [
            'current'   => [],
            'standart'  => [],
            'convert'   => ['2015.30.03'],
            'compare'   => ['2015.30.03', '>', '2015.30.02'],
            'toNumeric' => ['2015.30.03'],
            'calculate' => ['2015.30.03', '-30 day'],
            'set'       => ['Y-m-d']
        ]
    ];
}
