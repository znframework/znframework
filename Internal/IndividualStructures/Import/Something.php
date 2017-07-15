<?php namespace ZN\IndividualStructures\Import;

use Config, URL, File;
use ZN\IndividualStructures\Import\Exception\InvalidArgumentException;

class Something
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
    // something()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $page
    // @param array  $data
    // @param bool   $contents
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(String $randomPageVariable, Array $randomDataVariable = NULL, Bool $randomObGetContentsVariable = false)
    {
        if( ! empty(Properties::$parameters['usable']) )
        {
            $randomObGetContentsVariable = Properties::$parameters['usable'];
        }

        if( ! empty(Properties::$parameters['data']) )
        {
            $randomDataVariable = Properties::$parameters['data'];
        }

        Properties::$parameters = [];

        $eol = EOL;

        $randomPageVariableExtension = File::extension($randomPageVariable);
        $randomPageVariableBaseUrl   = URL::base($randomPageVariable);

        $return = '';

        if( ! is_file($randomPageVariable) )
        {
            throw new InvalidArgumentException('Error', 'fileParameter', '1.($randomPageVariable)');
        }

        if( $randomPageVariableExtension === 'js' )
        {
            $return = '<script type="text/javascript" src="'.$randomPageVariableBaseUrl.'"></script>'.$eol;
        }
        elseif( $randomPageVariableExtension === 'css' )
        {
            $return = '<link href="'.$randomPageVariableBaseUrl.'" rel="stylesheet" type="text/css" />'.$eol;
        }
        elseif( stristr('svg|woff|otf|ttf|'.implode('|', Properties::$differentFontExtensions), $randomPageVariableExtension) )
        {
            $return = '<style type="text/css">@font-face{font-family:"'.\Strings::divide(File::removeExtension($randomPageVariable), "/", -1).'"; src:url("'.$randomPageVariableBaseUrl.'") format("truetype")}</style>'.$eol;
        }
        elseif( $randomPageVariableExtension === 'eot' )
        {
            $return = '<style type="text/css"><!--[if IE]>@font-face{font-family:"'.\Strings::divide(File::removeExtension($randomPageVariable), "/", -1).'"; src:url("'.$randomPageVariableBaseUrl.'") format("truetype")}<![endif]--></style>'.$eol;
        }
        else
        {
            $randomPageVariable = suffix($randomPageVariable, '.php');

            if( is_file($randomPageVariable) )
            {
                if( is_array($randomDataVariable) )
                {
                    extract($randomDataVariable, EXTR_OVERWRITE, 'zn');
                }

                if( $randomObGetContentsVariable === false )
                {
                    require($randomPageVariable);
                }
                else
                {
                    ob_start();
                    require($randomPageVariable);
                    $randomSomethingFileContent = ob_get_contents();
                    ob_end_clean();

                    return $randomSomethingFileContent;
                }
            }
        }

        if( $randomObGetContentsVariable === false )
        {
            echo $return;
        }
        else
        {
            return $return;
        }
    }
}
