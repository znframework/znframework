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

use ZN\IS;
use ZN\Base;
use ZN\Config;
use ZN\Request;
use ZN\Inclusion\Project\Theme;

class BootstrapExtends
{
    /**
     * Protected Parameters
     */
    protected static function _parameters($arguments, $cdn)
    {
        if( ! empty(Properties::$parameters['usable']) )
        {
            $lastParam = Properties::$parameters['usable'];

            Properties::$parameters = [];
        }
        else
        {
            $argumentCount = count($arguments) - 1;
            $lastParam     = $arguments[$argumentCount] ?? false;
        }

        $arguments = array_unique($arguments);

        if( $lastParam === true )
        {
            array_pop($arguments);
        }

        return (object)
        [
            'arguments' => $arguments,
            'lastParam' => $lastParam,
            'cdnLinks'  => array_change_key_case(Config::get('CDNLinks', $cdn))
        ];
    }

    /**
     * Protected Gettype
     */
    public static function gettype($function, $scripts)
    {
        $str       = '';
        $eol       = EOL;
        $args      = self::_parameters($scripts, $function . 's');
        $lastParam = $args->lastParam;
        $arguments = $args->arguments;
        $links     = $args->cdnLinks;
        $scriptFix = $function . '_';
        
        foreach( $arguments as $script )
        {
            if( is_array($script) )
            {
                $script = '';
            }
         
            if( IS::url($script) )
            {
                $str .= static::tag($script);
            }
            else
            {
                $projectFontDirectory  = THEMES_DIR . Theme::$active;
                $externalFontDirectory = EXTERNAL_THEMES_DIR . Theme::$active;
              
                $scriptFile = $projectFontDirectory . ($suffix = Base::suffix($script, $function === 'script' ? '.js' : '.css'));
                
                if( ! is_file($scriptFile) )
                {
                    $scriptFile = $externalFontDirectory . $suffix;
                }

                if( ! in_array($scriptFix . $script, Properties::$isImport) )
                {
                    if( is_file($scriptFile) )
                    {
                        $str .= static::tag(Request::getBaseURL($scriptFile));
                    }
                    elseif( $lowerLinkName = ($links[strtolower($script)] ?? NULL) )
                    {
                        $str .= static::tag($lowerLinkName);
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
