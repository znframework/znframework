<?php namespace ZN\IndividualStructures\Import;

use Config, URL, File, Buffer;
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
            $return = Script::tag($randomPageVariableBaseUrl);
        }
        elseif( $randomPageVariableExtension === 'css' )
        {
            $return = Style::tag($randomPageVariableBaseUrl);
        }
        elseif( stristr('svg|woff|otf|ttf|'.implode('|', Config::expressions('differentFontExtensions')), $randomPageVariableExtension) )
        {
            $return = $this->_style($randomPageVariable, $randomPageVariableBaseUrl);
        }
        elseif( $randomPageVariableExtension === 'eot' )
        {
            $$return = $this->_style($randomPageVariable, $randomPageVariableBaseUrl, true);
        }
        else
        {
            $randomPageVariable = suffix($randomPageVariable, '.php');

            if( is_file($randomPageVariable) )
            {
                $return = Buffer::file($randomPageVariable, $randomDataVariable);

                if( $randomObGetContentsVariable === false )
                {
                    echo $return; return;
                }
                else
                {
                    return $return;
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

    //--------------------------------------------------------------------------------------------------------
    // protected style()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $randomPageVariable
    // @param string $randomPageVariableBaseUrl
    // @param bool   $ie = false
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _style($randomPageVariable, $randomPageVariableBaseUrl, $ie = false)
    {
        return '<style type="text/css">
                    '.( $ie === true ? '<!--[if IE]>' : NULL ).'
                    @font-face{font-family:"'.\Strings::divide(File::removeExtension($randomPageVariable), "/", -1).'";
                    src:url("'.$randomPageVariableBaseUrl.'")
                    format("truetype")}
                    '.( $ie === true ? '<![endif]-->' : NULL ).'
                </style>' . EOL;
    }
}
