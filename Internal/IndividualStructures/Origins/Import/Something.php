<?php namespace ZN\IndividualStructures\Import;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Services\URL;
use ZN\IndividualStructures\Exception\InvalidArgumentException;
use ZN\DataTypes\Strings;
use ZN\FileSystem\File;
use ZN\IndividualStructures\Buffer;

class Something
{
    //--------------------------------------------------------------------------------------------------------
    // something()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $page
    // @param array  $data
    // @param bool   $contents
    //
    //--------------------------------------------------------------------------------------------------------
    public static function use(String $randomPageVariable, Array $randomDataVariable = NULL, Bool $randomObGetContentsVariable = false)
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

        $randomPageVariableExtension = File\Extension::get($randomPageVariable);
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
        elseif( stristr('svg|woff|otf|ttf|'.implode('|', \Config::expressions('differentFontExtensions')), $randomPageVariableExtension) )
        {
            $return = self::_style($randomPageVariable, $randomPageVariableBaseUrl);
        }
        elseif( $randomPageVariableExtension === 'eot' )
        {
            $$return = self::_style($randomPageVariable, $randomPageVariableBaseUrl, true);
        }
        else
        {
            $randomPageVariable = suffix($randomPageVariable, '.php');

            if( is_file($randomPageVariable) )
            {
                $return = Buffer\File::do($randomPageVariable, $randomDataVariable);

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
    protected static function _style($randomPageVariable, $randomPageVariableBaseUrl, $ie = false)
    {
        return '<style type="text/css">
                    '.( $ie === true ? '<!--[if IE]>' : NULL ).'
                    @font-face{font-family:"'.Strings\Split::divide(File\Extension::remove($randomPageVariable), "/", -1).'";
                    src:url("'.$randomPageVariableBaseUrl.'")
                    format("truetype")}
                    '.( $ie === true ? '<![endif]-->' : NULL ).'
                </style>' . EOL;
    }
}
