<?php namespace ZN\ViewObjects\View;

use FactoryController;

class InternalBS extends FactoryController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    use BSCommonMethodsTrait;

    const factory =
    [
        'methods' =>
        [
            'bar'        => 'BS\Progress::bar',
            'pagination' => 'BS\Pagination::create',
            'url'        => 'BS\Pagination::url:this',
            'image'      => 'BS\Image::use',
            'alt'        => 'BS\Image::alt:this',
            'well'       => 'BS\Well::use',
            'alert'      => 'BS\Alert::use',
            'button'     => 'BS\Button::button',
            'submit'     => 'BS\Button::submit',
            'buttonlink' => 'BS\Button::buttonlink',
        ]
    ];
}
