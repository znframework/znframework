<?php namespace ZN;
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

class Import extends Factory
{
    const factory =
    [
        'methods' =>
        [
            'usable'     => 'Inclusion\Properties::usable:this',
            'recursive'  => 'Inclusion\Properties::recursive:this',
            'data'       => 'Inclusion\Properties::data:this',
            'headdata'   => 'Inclusion\Masterpage::headData:this',
            'body'       => 'Inclusion\Masterpage::body:this',
            'head'       => 'Inclusion\Masterpage::head:this',
            'title'      => 'Inclusion\Masterpage::title:this',
            'meta'       => 'Inclusion\Masterpage::meta:this',
            'attributes' => 'Inclusion\Masterpage::attributes:this',
            'content'    => 'Inclusion\Masterpage::content:this',
            'bodycontent'=> 'Inclusion\Masterpage::bodyContent:this',
            'masterpage' => 'Inclusion\Masterpage::use',
            'page'       => 'Inclusion\View::use',
            'view'       => 'Inclusion\View::use',
            'handload'   => 'Inclusion\Handload::use',
            'template'   => 'Inclusion\Template::use',
            'font'       => 'Inclusion\Font::use',
            'style'      => 'Inclusion\Style::use',
            'script'     => 'Inclusion\Script::use',
            'something'  => 'Inclusion\Something::use',
            'package'    => 'Inclusion\Package::use',
            'theme'      => 'Inclusion\Package::theme',
            'plugin'     => 'Inclusion\Package::plugin',
            'resource'   => 'Inclusion\Package::resource'
        ]
    ];
}
