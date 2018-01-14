<?php namespace ZN\XML;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controller\Factory;

class Processor extends Factory
{
    const factory =
    [
        'methods' =>
        [
            'version'     => 'Builder::version:this',
            'encoding'    => 'Builder::encoding:this',
            'build'       => 'Builder::do',
            'save'        => 'Save::do',
            'load'        => 'Loader::do',
            'parse'       => 'Parser::do',
            'parsearray'  => 'Parser::array',
            'parsejson'   => 'Parser::json',
            'parseobject' => 'Parser::object',
            'parsesimple' => 'Parser::simple',
            'check'       => 'Check::check',
        ]
    ];
}
