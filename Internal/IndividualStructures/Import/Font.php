<?php namespace ZN\IndividualStructures\Import;

use Config, Import, URL, File;

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
    public function use(...$fonts)
    {
        $eol       = EOL;
        $str       = "<style type='text/css'>".$eol;
        $args      = $this->_parameters($fonts, 'fonts');
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

            $f = $this->_fontName($font);

            $fontFile = FONTS_DIR . $font;

            if( ! is_file($fontFile) && is_dir($fontFile) )
            {
                $fontFile = EXTERNAL_FONTS_DIR.$font;
            }

            $baseUrl  = URL::base($fontFile);

            if( is_file(suffix($fontFile, '.svg')) )
            {
                $str .= $this->_face($f, $baseUrl, 'svg');
            }

            if( is_file(suffix($fontFile, '.woff')) )
            {
                $str .= $this->_face($f, $baseUrl, 'woff');
            }

            // OTF IE VE CHROME DESTEKLEMIYOR
            if( is_file(suffix($fontFile, '.otf')) )
            {
                $str .= $this->_face($f, $baseUrl, 'otf');
            }

            // TTF IE DESTEKLEMIYOR
            if( is_file(suffix($fontFile, '.ttf')) )
            {
                $str .= $this->_face($f, $baseUrl, 'ttf');
            }

            // CND ENTEGRASYON
            $cndFont = isset($links[strtolower($font)]) ? $links[strtolower($font)] : NULL;

            if( ! empty($cndFont) )
            {
                $str .= $this->_face($this->_fontName($cndFont), $cndFont);
            }

            // FARKLI FONTLAR
            $differentSet = Config::expressions('differentFontExtensions');

            if( ! empty($differentSet) )
            {
                foreach( $differentSet as $of )
                {
                    if( is_file($fontFile.prefix($of, '.')) )
                    {
                        $str .= $this->_face($f, $baseUrl . prefix($of, '.'));
                    }
                }
            }

            // EOT IE DESTEKLIYOR
            if( is_file(suffix($fontFile, '.eot')) )
            {
                $str .= '<!--[if IE]>';
                $str .= $this->_face($f, $baseUrl, 'eot');
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
    protected function _fontName($font)
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
    protected function _face($f, $baseUrl, $extension = NULL)
    {
        $base = $baseUrl;

        if( $extension !== NULL )
        {
            $base = suffix($baseUrl, '.' . $extension);
        }

        return '@font-face{font-family:"' . File::removeExtension($f) . '"; src:url("' . $base . '") format("truetype")}' . EOL;
    }
}
