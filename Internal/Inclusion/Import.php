<?php namespace ZN\Inclusion;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controllers\FactoryController;

class Import extends FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'usable'     => 'Properties::usable:this',
            'recursive'  => 'Properties::recursive:this',
            'data'       => 'Properties::data:this',
            'headdata'   => 'Masterpage::headData:this',
            'body'       => 'Masterpage::body:this',
            'head'       => 'Masterpage::head:this',
            'title'      => 'Masterpage::title:this',
            'meta'       => 'Masterpage::meta:this',
            'attributes' => 'Masterpage::attributes:this',
            'content'    => 'Masterpage::content:this',
            'bodycontent'=> 'Masterpage::bodyContent:this',
            'masterpage' => 'Masterpage::use',
            'page'       => 'View::use',
            'view'       => 'View::use',
            'handload'   => 'Handload::use',
            'template'   => 'Template::use',
            'font'       => 'Font::use',
            'style'      => 'Style::use',
            'script'     => 'Script::use',
            'something'  => 'Something::use',
            'package'    => 'Package::use',
            'theme'      => 'Package::theme',
            'plugin'     => 'Package::plugin',
            'resource'   => 'Package::resource'
        ]
    ];
}
