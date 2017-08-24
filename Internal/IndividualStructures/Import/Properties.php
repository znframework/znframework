<?php namespace ZN\IndividualStructures\Import;

class Properties
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //----------------------------------------------------------------------------------------------
    // Different Font Extensions
    //----------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: SVG, WOFF, EOT, OTF, TTF uzantılı fontlar dışında başka bir uzantılı
    // font kullanacaksınız aşağıdaki diziye eklemeniz gerekmektedir. Uzantı başında (.) nokta
    // karakteri kullanmanıza gerek yoktur. Örnek array('ufo', 'fon') şeklinde yazmanız
    // yeterlidir.
    //
    //----------------------------------------------------------------------------------------------
    public static $differentFontExtensions = [];

    //--------------------------------------------------------------------------------------------------
    // Doctype
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Döküman türleri listesi.
    //
    //--------------------------------------------------------------------------------------------------
    public static $doctype =
    [
        'xhtml1Strict'          => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//TR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
        'xhtml1Transitional'    => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//TR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
        'xhtml1Frameset'        => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//TR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
        'xhtml11'               => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//TR" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
        'html4Strict'           => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//TR" "http://www.w3.org/TR/html4/strict.dtd">',
        'html4Transitional'     => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//TR" "http://www.w3.org/TR/html4/loose.dtd">',
        'html4Frameset'         => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//TR" "http://www.w3.org/TR/html4/frameset.dtd">',
        'html5'                 => '<!DOCTYPE html>'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Is Import
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    public static $isImport = [];

    //--------------------------------------------------------------------------------------------------------
    // Parameters
    //--------------------------------------------------------------------------------------------------------
    //
    // @var bool
    //
    //--------------------------------------------------------------------------------------------------------
    public static $parameters =
    [
        'data'   => [],
        'usable' => false
    ];

    //--------------------------------------------------------------------------------------------------------
    // Usable
    //--------------------------------------------------------------------------------------------------------
    //
    // @param bool $usable
    //
    //--------------------------------------------------------------------------------------------------------
    public function usable(Bool $usable = true)
    {
        self::$parameters['usable'] = $usable;
    }

    //--------------------------------------------------------------------------------------------------------
    // recursive()
    //--------------------------------------------------------------------------------------------------------
    //
    // @var bool $recursive
    //
    //--------------------------------------------------------------------------------------------------------
    public function recursive(Bool $recursive = true)
    {
        self::$parameters['recursive'] = $recursive;
    }

    //--------------------------------------------------------------------------------------------------------
    // data()
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function data(Array $data)
    {
        self::$parameters['data'] = $data;
    }
}
