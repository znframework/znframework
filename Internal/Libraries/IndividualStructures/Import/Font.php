<?php namespace ZN\IndividualStructures\Import;

use Config, Import;

class Font extends BootstrapExtends implements BootsrapInterface
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

        foreach( $arguments as $font )
        {
            if( is_array($font) )
            {
                $font = '';
            }

            $f = divide($font, "/", -1);
            // SVG IE VE MOZILLA DESTEKLEMIYOR

            $fontFile = FONTS_DIR.$font;

            if( ! is_file($fontFile) )
            {
                $fontFile = EXTERNAL_FONTS_DIR.$font;
            }

            $baseUrl  = baseUrl($fontFile);

            if( extension($fontFile) )
            {
                if( is_file($fontFile) )
                {
                    $strEx = Import::something($fontFile, '', true);

                    break;
                }
            }

            if( is_file($fontFile.".svg") )
            {
                $str .= '@font-face{font-family:"'.$f.'"; src:url("'.$baseUrl.'.svg") format("truetype")}'.$eol;
            }

            if( is_file($fontFile.".woff") )
            {
                $str .= '@font-face{font-family:"'.$f.'"; src:url("'.$baseUrl.'.woff") format("truetype")}'.$eol;
            }

            // OTF IE VE CHROME DESTEKLEMIYOR
            if( is_file($fontFile.".otf") )
            {
                $str .= '@font-face{font-family:"'.$f.'"; src:url("'.$baseUrl.'.otf") format("truetype")}'.$eol;
            }

            // TTF IE DESTEKLEMIYOR
            if( is_file($fontFile.".ttf") )
            {
                $str .= '@font-face{font-family:"'.$f.'"; src:url("'.$baseUrl.'.ttf") format("truetype")}'.$eol;
            }

            // CND ENTEGRASYON

            $cndFont = isset($links[strtolower($font)]) ? $links[strtolower($font)] : NULL;

            if( ! empty($cndFont) )
            {
                $str .= '@font-face{font-family:"'.divide(removeExtension($cndFont), "/", -1).'"; src:url("'.$cndFont.'") format("truetype")}'.$eol;
            }

            // FARKLI FONTLAR
            $differentSet = Config::get('ViewObjects', 'font')['differentFontExtensions'];

            if( ! empty($differentSet) )
            {
                foreach( $differentSet as $of )
                {
                    if( is_file($fontFile.prefix($of, '.')) )
                    {
                        $str .= '@font-face{font-family:"'.$f.'"; src:url("'.$baseUrl.prefix($of, '.').'") format("truetype")}'.$eol;
                    }
                }
            }

            // EOT IE DESTEKLIYOR
            if( is_file($fontFile.".eot") )
            {
                $str .= '<!--[if IE]>';
                $str .= '@font-face{font-family:"'.$f.'"; src:url("'.$baseUrl.'.eot") format("truetype")}';
                $str .= '<![endif]-->';
                $str .= $eol;
            }
        }

        $str .= '</style>'.$eol;

        if( isset($strEx) )
        {
            $str = $strEx;
        }

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
}
