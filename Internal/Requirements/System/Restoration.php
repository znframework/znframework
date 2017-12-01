<?php namespace ZN\Requirements\System;

use Config, User;
use ZN\In;
use ZN\Services\URI;
use ZN\FileSystem\Folder;
use ZN\IndividualStructures\IS;

class Restoration
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    protected static $restoreFix = 'Restore';

    //--------------------------------------------------------------------------------------------------------
    // create -> 5.3.8[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $project
    // @param mixed  $folders = 'standart' - options: standart, full or array
    //
    //--------------------------------------------------------------------------------------------------------
    public static function start(String $project, $folders = 'standart')
    {
        $restoreFix = self::$restoreFix;

        if( $folders === 'full' )
        {
            return Forge::copy(PROJECTS_DIR . $project, PROJECTS_DIR . $restoreFix . $project);
        }
        else
        {
            $array = ['Views', 'Controllers', 'Storage'];

            if( $folders !== 'standart' )
            {
                $array = array_merge($array, $folders);
            }
    
            foreach( $array as $folder )
            {
                $path   = $project . DS . $folder;
                $return = Folder\Forge::copy(PROJECTS_DIR . $path, PROJECTS_DIR . $restoreFix . $path);
            }

            return $return;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // end -> 5.3.8[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $project
    // @param string $type = NULL - options: NULL or 'delete'
    //
    //--------------------------------------------------------------------------------------------------------
    public static function end(String $project, String $type = NULL)
    {
        $project = prefix($project, self::$restoreFix);
        $return  = Folder\Forge::copy($restoreFolder = PROJECTS_DIR . $project, PROJECTS_DIR . ltrim($project, self::$restoreFix));

        if( $type === 'delete' )
        {
            return Folder\Forge::delete($restoreFolder);
        }

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // endDelete -> 5.3.8[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $project
    //
    //--------------------------------------------------------------------------------------------------------
    public static function endDelete(String $project)
    {
        return self::end($project, 'delete');
    }

    //--------------------------------------------------------------------------------------------------------
    // routeURI
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $machinesIP
    // @param string $uri
    //
    //--------------------------------------------------------------------------------------------------------
    public static function routeURI($machinesIP, String $uri)
    {
        if( ! in_array(User::ip(), (array) $machinesIP) && In::requestURI() !== $uri )
        {
            redirect($uri);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Is Machines IP
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function isMachinesIP($manipulation = NULL)
    {
        $projects      = Config::get('Project');
        $restorationIP = $projects['restoration']['machinesIP'];

        if( PROJECT_MODE === 'restoration' || $manipulation !== NULL)
        {
            $ipv4 = User::ip();

            if( is_array($restorationIP) )
            {
                $result = (bool) in_array($ipv4, $restorationIP);
            }
            elseif( $ipv4 == $restorationIP )
            {
                $result = true;
            }
            else
            {
                $result = false;
            }
        }
        else
        {
            $result = false;
        }

        return $result;
    }

    //--------------------------------------------------------------------------------------------------------
    // Mode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function mode($settings = NULL)
    {
        $restorable = NULL;

        if( isset($settings['machinesIP']) )
        {
            $restorable = true;

            Config::set('Project', 'restoration', ['machinesIP' => $settings['machinesIP']]);
        }

        if( self::isMachinesIP($settings) === true )
        {
            return false;
        }

        error_reporting(0);

        $currentPath          = $restorable === true ? strtolower(CURRENT_CFUNCTION) : strtolower(URI::active());
        $projects             = Config::get('Project');
        $restoration          = $projects['restoration'];
        $restorationPages     = $restorable === true && ! isset($settings['functions'])
                              ? ['main']
                              : (array) ($settings['functions'] ?? $restoration['pages']);
        $restorationRoutePage = $settings['routePage'] ?? $restoration['routePage'];
        $routePage            = strtolower($restorationRoutePage);

        if( IS::array($restorationPages) )
        {
            if( $restorationPages[0] === 'all' )
            {
                if( $currentPath !== $routePage )
                {
                    redirect($restorationRoutePage);
                }
            }

            foreach( $restorationPages as $k => $rp )
            {
                if( strstr($currentPath, strtolower($k)) )
                {
                    redirect($rp);
                }
                else
                {
                    if( strstr($currentPath, strtolower($rp)) )
                    {
                        if( $currentPath !== $routePage )
                        {
                            redirect($restorationRoutePage);
                        }
                    }
                }
            }
        }
    }
}

class_alias('ZN\Requirements\System\Restoration', 'Restoration');
