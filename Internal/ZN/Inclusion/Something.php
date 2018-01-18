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
use ZN\Config;
use ZN\Request;
use ZN\Datatype;
use ZN\Buffering;
use ZN\Filesystem;
use ZN\Inclusion\Exception\InvalidArgumentException;

class Something
{
    /**
     * Import Somehing
     * 
     * @param string $randomPageVariable
     * @param array  $randomDataVariable          = NULL
     * @param bool   $randomObGetContentsVariable = false
     * 
     * @return mixed
     */
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

        $randomPageVariableExtension = Filesystem::getExtension($randomPageVariable);
        $randomPageVariableBaseUrl   = Request::getBaseURL($randomPageVariable);

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
            $return = self::_style($randomPageVariable, $randomPageVariableBaseUrl);
        }
        elseif( $randomPageVariableExtension === 'eot' )
        {
            $$return = self::_style($randomPageVariable, $randomPageVariableBaseUrl, true);
        }
        else
        {
            $randomPageVariable = Base::suffix($randomPageVariable, '.php');

            if( is_file($randomPageVariable) )
            {
                $return = Buffering::file($randomPageVariable, $randomDataVariable);

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

    /**
     * Protected Style
     */
    protected static function _style($randomPageVariable, $randomPageVariableBaseUrl, $ie = false)
    {
        return '<style type="text/css">
                    '.( $ie === true ? '<!--[if IE]>' : NULL ).'
                    @font-face{font-family:"'.Datatype::divide(Filesystem::removeExtension($randomPageVariable), "/", -1).'";
                    src:url("'.$randomPageVariableBaseUrl.'")
                    format("truetype")}
                    '.( $ie === true ? '<![endif]-->' : NULL ).'
                </style>' . EOL;
    }
}
