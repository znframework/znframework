<?php namespace ZN\IndividualStructures;

class InternalImport extends \FactoryController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const factory =
    [
        'methods' =>
        [
            'usable'     => 'Import\Properties::usable:this',
            'recursive'  => 'Import\Properties::recursive:this',
            'data'       => 'Import\Properties::data:this',
            'headdata'   => 'Import\Masterpage::headData:this',
            'body'       => 'Import\Masterpage::body:this',
            'head'       => 'Import\Masterpage::head:this',
            'title'      => 'Import\Masterpage::title:this',
            'meta'       => 'Import\Masterpage::meta:this',
            'attributes' => 'Import\Masterpage::attributes:this',
            'content'    => 'Import\Masterpage::content:this',
            'bodycontent'=> 'Import\Masterpage::bodyContent:this',
            'masterpage' => 'Import\Masterpage::use',
            'page'       => 'Import\View::use',
            'view'       => 'Import\View::use',
            'handload'   => 'Import\Handload::use',
            'template'   => 'Import\Template::use',
            'font'       => 'Import\Font::use',
            'style'      => 'Import\Style::use',
            'script'     => 'Import\Script::use',
            'something'  => 'Import\Something::use',
            'package'    => 'Import\Package::use',
            'theme'      => 'Import\Package::theme',
            'plugin'     => 'Import\Package::plugin'
        ]
    ];
}
