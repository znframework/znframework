<?php namespace ZN\ImageProcessing;

class InternalImage extends \FactoryController implements InternalImageInterface
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
            'thumb'      => 'Image\RenderImage::do',
            'getprosize' => 'Image\CalculateProsize::do',
        ]
    ];
}
