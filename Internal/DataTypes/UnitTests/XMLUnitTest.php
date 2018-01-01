<?php namespace ZN\DataTypes;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class XMLUnitTest extends \UnitTestController
{
    const unit =
    [
        'class'   => 'XML',
        'methods' =>
        [
            'version'  => [],
            'encoding' => [],
            'build'    => [['name' => 'media', 'attr' => ['id' => 1]]],
            'save'     => ['p1', 'p2'],
            'load'     => ['p1'],
            'parse'    => ['<media id="1"></media>']
        ]
    ];
}
