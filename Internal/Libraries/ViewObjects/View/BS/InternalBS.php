<?php namespace ZN\ViewObjects\View;

use FactoryController;
use ZN\ViewObjects\View\BS\Properties;

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

    const factory =
    [
        'methods' =>
        [
            'bar'        => 'BS\Progress::bar',
            'type'       => 'BS\Progress::type',
            'pagination' => 'BS\Pagination::create',
            'url'        => 'BS\Pagination::url:this',
        ]
    ];

    //--------------------------------------------------------------------------------------------------------
    // Class
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $class = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function class(String $class = NULL)
    {
        Properties::$class = $class;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Size
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $size = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function size(String $size = NULL)
    {
        Properties::$size = $size;

        return $this;
    }
}
