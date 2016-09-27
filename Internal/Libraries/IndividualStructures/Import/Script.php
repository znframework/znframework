<?php namespace ZN\IndividualStructures\Import;

class Script extends BootstrapExtends implements BootsrapInterface
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
    // scripts()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $scripts
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(...$scripts)
    {
        $str       = '';
        $eol       = EOL;
        $args      = $this->_parameters($scripts, 'scripts');
        $lastParam = $args->lastParam;
        $arguments = $args->arguments;
        $links     = $args->cdnLinks;

        foreach( $arguments as $script )
        {
            if( is_array($script) )
            {
                $script = '';
            }

            $scriptFile = SCRIPTS_DIR.suffix($script, ".js");

            if( ! is_file($scriptFile) )
            {
                $scriptFile = EXTERNAL_SCRIPTS_DIR.suffix($script, ".js");
            }

            if( ! in_array("script_".$script, Properties::$isImport) )
            {
                if( is_file($scriptFile) )
                {
                    $str .= '<script type="text/javascript" src="'.baseUrl($scriptFile).'"></script>'.$eol;
                }
                elseif( isUrl($script) && extension($script) === 'js' )
                {
                    $str .= '<script type="text/javascript" src="'.$script.'"></script>'.$eol;
                }
                elseif( isset($links[strtolower($script)]) )
                {
                    $str .= '<script type="text/javascript" src="'.$links[strtolower($script)].'"></script>'.$eol;
                }

                Properties::$isImport[] = "script_".$script;
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
