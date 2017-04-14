<?php namespace ZN\ViewObjects\View\BS;

use Html;

class Image implements ImageInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    protected $alt;

    //--------------------------------------------------------------------------------------------------------
    // Alt
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $alt = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function alt(String $alt = NULL) : InternalBS
    {
        $this->alt = $alt;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Image
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $value   = NULL
    // @param int    $percent = 0
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(String $image = NULL, Int $width = NULL, Int $height = NULL) : String
    {
        $return = Html::attr
        ([
            'src'    => baseUrl($image),
            'class'  => 'img-' .(Properties::$type ?? 'rounded'),
            'alt'    => $this->alt,
        ])->image($image, $width, $height);

        Properties::$type = NULL;

        return $return;
    }
}
