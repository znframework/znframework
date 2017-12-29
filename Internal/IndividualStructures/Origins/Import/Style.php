<?php namespace ZN\IndividualStructures\Import;

use Project\Controllers\Theme;
use ZN\IndividualStructures\IS;
use ZN\Services\URL;

class Style extends BootstrapExtends
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
    // static tag() -> 5.3.2
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $src = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public static function tag(String $src = NULL) : String
    {
        return '<link href="'.$src.'" rel="stylesheet" type="text/css" />' . EOL;
    }

    //--------------------------------------------------------------------------------------------------------
    // style()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $styles
    //
    //--------------------------------------------------------------------------------------------------------
    public static function use(...$styles)
    {
        $str       = '';
        $eol       = EOL;
        $args      = self::_parameters($styles, 'styles');
        $lastParam = $args->lastParam;
        $arguments = $args->arguments;
        $links     = $args->cdnLinks;
        $styleFix  = 'style_';

        foreach( $arguments as $style )
        {
            if( is_array($style) )
            {
                $style = '';
            }

            if( IS::url($style) )
            {
                $str .= self::tag($style);
            }
            else
            {
                if( ! is_dir(STYLES_DIR) )
                {
                    $projectFontDirectory  = THEMES_DIR . Theme::$active;
                    $externalFontDirectory = EXTERNAL_THEMES_DIR . Theme::$active;
                }
                else
                {
                    $projectFontDirectory  = STYLES_DIR;
                    $externalFontDirectory = EXTERNAL_STYLES_DIR;
                }

                $styleFile = $projectFontDirectory . ($suffix = suffix($style, '.css'));
                
                if( ! is_file($styleFile) )
                {
                    $styleFile = $externalFontDirectory . $suffix;
                }
    
                if( ! in_array($styleFix . $style, Properties::$isImport) )
                {
                    if( is_file($styleFile) )
                    {
                        $str .= self::tag(URL::base($styleFile));
                    }
                    elseif( $lowerLinkName = ($links[strtolower($style)] ?? NULL) )
                    {
                        $str .= self::tag($lowerLinkName);
                    }
    
                    Properties::$isImport[] = $styleFix . $style;
                }
            }
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
