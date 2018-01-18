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


use ZN\Base;
use ZN\Request;
use ZN\Filesystem;
use ZN\Inclusion\Project\Theme;

class Font extends BootstrapExtends
{
    /**
     * Get Fonts
     * 
     * @param string ...$fonts
     * 
     * @return mixed
     */
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

            if( ! is_dir(FONTS_DIR) )
            {
                $projectFontDirectory  = THEMES_DIR . Theme::$active;
                $externalFontDirectory = EXTERNAL_THEMES_DIR . Theme::$active;
            }
            else
            {
                $projectFontDirectory  = FONTS_DIR;
                $externalFontDirectory = EXTERNAL_FONTS_DIR;
            }

            $fontFile = $projectFontDirectory . $font;

            if( ! is_file($fontFile) && is_dir($fontFile) ) $fontFile = $externalFontDirectory . $font;
        
            $baseUrl = Request::getBaseURL($fontFile);

            if( is_file(Base::suffix($fontFile, '.svg')) ) $str .= self::_face($f, $baseUrl, 'svg');
            if( is_file(Base::suffix($fontFile, '.woff'))) $str .= self::_face($f, $baseUrl, 'woff');
            if( is_file(Base::suffix($fontFile, '.otf')) ) $str .= self::_face($f, $baseUrl, 'otf');
            if( is_file(Base::suffix($fontFile, '.ttf')) ) $str .= self::_face($f, $baseUrl, 'ttf');

            $cndFont = isset($links[strtolower($font)]) ? $links[strtolower($font)] : NULL;

            if( ! empty($cndFont) ) $str .= self::_face(self::_fontName($cndFont), $cndFont);
        
            $differentSet = Config::expressions('differentFontExtensions');

            if( ! empty($differentSet) )
            {
                foreach( $differentSet as $of )
                {
                    if( is_file($fontFile.Base::prefix($of, '.')) )
                    {
                        $str .= self::_face($f, $baseUrl . Base::prefix($of, '.'));
                    }
                }
            }

            // EOT IE DESTEKLIYOR
            if( is_file(Base::suffix($fontFile, '.eot')) )
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

    /**
     * Protected Font Name
     */
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

    /**
     * Protected Font Face
     */
    protected static function _face($f, $baseUrl, $extension = NULL)
    {
        $base = $baseUrl;

        if( $extension !== NULL )
        {
            $base = Base::suffix($baseUrl, '.' . $extension);
        }

        return '@font-face{font-family:"' . Filesystem::removeExtension($f) . '"; src:url("' . $base . '") format("truetype")}' . EOL;
    }
}
