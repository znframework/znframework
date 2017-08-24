<?php namespace ZN\IndividualStructures\Import;

use URL, IS;

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
    // style()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $styles
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(...$styles)
    {
        $str       = '';
        $eol       = EOL;
        $args      = $this->_parameters($styles, 'styles');
        $lastParam = $args->lastParam;
        $arguments = $args->arguments;
        $links     = $args->cdnLinks;

        foreach( $arguments as $style )
        {
            if( is_array($style) )
            {
                $style = '';
            }

            $styleFile = STYLES_DIR.suffix($style,".css");

            if( ! is_file($styleFile) )
            {
                $styleFile = EXTERNAL_STYLES_DIR.suffix($style, ".css");
            }

            if( ! in_array("style_".$style, Properties::$isImport) )
            {
                if( is_file($styleFile) )
                {
                    $str .= '<link href="'.URL::base($styleFile).'" rel="stylesheet" type="text/css" />'.$eol;
                }
                elseif( IS::url($style) )
                {
                    $str .= '<link href="'.$style.'" rel="stylesheet" type="text/css" />'.$eol;
                }
                elseif( isset($links[strtolower($style)]) )
                {
                    $str .= '<link href="'.$links[strtolower($style)].'" rel="stylesheet" type="text/css" />'.$eol;
                }

                Properties::$isImport[] = "style_".$style;
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
