<?php namespace ZN\IndividualStructures\Import;

use ZN\IndividualStructures\IS;
use ZN\Services\URL;

class Script extends BootstrapExtends
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
        return '<script type="text/javascript" src="'.$src.'"></script>' . EOL;
    }

    //--------------------------------------------------------------------------------------------------------
    // scripts()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $scripts
    //
    //--------------------------------------------------------------------------------------------------------
    public static function use(...$scripts)
    {
        $str       = '';
        $eol       = EOL;
        $args      = self::_parameters($scripts, 'scripts');
        $lastParam = $args->lastParam;
        $arguments = $args->arguments;
        $links     = $args->cdnLinks;
        $scriptFix = 'script_';

        foreach( $arguments as $script )
        {
            if( is_array($script) )
            {
                $script = '';
            }

            if( IS::url($script) )
            {
                $str .= self::tag($script);
            }
            else
            {
                $scriptFile = SCRIPTS_DIR . ($suffix = suffix($script, '.js'));

                if( ! is_file($scriptFile) )
                {
                    $scriptFile = EXTERNAL_SCRIPTS_DIR . $suffix;
                }

                if( ! in_array($scriptFix . $script, Properties::$isImport) )
                {
                    if( is_file($scriptFile) )
                    {
                        $str .= self::tag(URL::base($scriptFile));
                    }
                    elseif( $lowerLinkName = ($links[strtolower($script)] ?? NULL) )
                    {
                        $str .= self::tag($lowerLinkName);
                    }

                    Properties::$isImport[] = $scriptFix . $script;
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
