<?php namespace ZN\IndividualStructures\Import;

use ZN\Services\URL;
use ZN\FileSystem\File;

class Font extends BootstrapExtends
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // font()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $fonts
    //
    //--------------------------------------------------------------------------------------------------------
    public static function use(...$fonts)
    {
        $eol       = EOL;
        $str       = "<style type='text/css'>".$eol;
        $args      = self::_parameters($fonts, 'fonts');
        $lastParam = $args->lastParam;
        $arguments = $args->arguments;
        $links     = $args->cdnLinks;
        $strEx     = NULL;

        foreach( $arguments as $font )
        {
            if( is_array($font) )
            {
                $font = '';
            }

            $f = self::_fontName($font);

            $fontFile = FONTS_DIR . $font;

            if( ! is_file($fontFile) && is_dir($fontFile) )
            {
                $fontFile = EXTERNAL_FONTS_DIR.$font;
            }

            $baseUrl  = URL::base($fontFile);

            if( is_file(suffix($fontFile, '.svg')) )
            {
                $str .= self::_face($f, $baseUrl, 'svg');
            }

            if( is_file(suffix($fontFile, '.woff')) )
            {
                $str .= self::_face($f, $baseUrl, 'woff');
            }

            // OTF IE VE CHROME DESTEKLEMIYOR
            if( is_file(suffix($fontFile, '.otf')) )
            {
                $str .= self::_face($f, $baseUrl, 'otf');
            }

            // TTF IE DESTEKLEMIYOR
            if( is_file(suffix($fontFile, '.ttf')) )
            {
                $str .= self::_face($f, $baseUrl, 'ttf');
            }

            // CND ENTEGRASYON
            $cndFont = isset($links[strtolower($font)]) ? $links[strtolower($font)] : NULL;

            if( ! empty($cndFont) )
            {
                $str .= self::_face(self::_fontName($cndFont), $cndFont);
            }

            // FARKLI FONTLAR
            $differentSet = Config::expressions('differentFontExtensions');

            if( ! empty($differentSet) )
            {
                foreach( $differentSet as $of )
                {
                    if( is_file($fontFile.prefix($of, '.')) )
                    {
                        $str .= self::_face($f, $baseUrl . prefix($of, '.'));
                    }
                }
            }

            // EOT IE DESTEKLIYOR
            if( is_file(suffix($fontFile, '.eot')) )
            {
                $str .= '<!--[if IE]>';
                $str .= self::_face($f, $baseUrl, 'eot');
                $str .= '<![endif]-->';
                $str .= $eol;
            }
        }

        $str .= '</style>'.$eol;

        if( ! empty($str) )
        {
            if( $lastParam === true )
            {
                return $str;
            }
            else
            {
                echo $str;
            }
        }
        else
        {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected fontName()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $font
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _fontName($font)
    {
        $divide = explode('/', $font);

        $sub  = NULL;
        $name = $divide[0];

        if( $sub = ($divide[1] ?? NULL) )
        {
            if( $name === $sub )
            {
                $sub = NULL;
            }
        }

        return $name . $sub;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected face()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $f
    // @param string $baseUrl
    // @param string $extension
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _face($f, $baseUrl, $extension = NULL)
    {
        $base = $baseUrl;

        if( $extension !== NULL )
        {
            $base = suffix($baseUrl, '.' . $extension);
        }

        return '@font-face{font-family:"' . File\Extension::remove($f) . '"; src:url("' . $base . '") format("truetype")}' . EOL;
    }
}
