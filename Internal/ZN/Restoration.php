<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Restoration
{
    /**
     * Restore fix
     * 
     * @var string
     */
    protected static $restoreFix = 'Restore';

    /**
     * Start restoration
     * 
     * @param string $project
     * @param mixed  $folders - options[standart|full|array]
     * 
     * @return bool
     */
    public static function start(String $project, $folders = 'standart')
    {
        $restoreFix = self::$restoreFix;

        if( $folders === 'full' )
        {
            return Filesystem::copy(PROJECTS_DIR . $project, PROJECTS_DIR . $restoreFix . $project);
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
                $return = Filesystem::copy(PROJECTS_DIR . $path, PROJECTS_DIR . $restoreFix . $path);
            }

            return $return;
        }
    }

    /**
     * End restoration
     * 
     * @param string $project
     * @param string $type = NULL - options[NULL|delete]
     * 
     * @return bool
     */
    public static function end(String $project, String $type = NULL)
    {
        $project = Base::prefix($project, self::$restoreFix);
        $return  = Filesystem::copy($restoreFolder = PROJECTS_DIR . $project, PROJECTS_DIR . ltrim($project, self::$restoreFix));

        if( $type === 'delete' )
        {
            return Filesystem::deleteFolder($restoreFolder);
        }

        return $return;
    }

    /**
     * End & delete restoration
     * 
     * @param string $project
     * 
     * @return bool
     */
    public static function endDelete(String $project)
    {
        return self::end($project, 'delete');
    }

    /**
     * Redirect request according to route.
     * 
     * @param mixed  $machinesIP
     * @param string $uri
     * 
     * @return void
     */
    public static function routeURI($machinesIP, String $uri)
    {
        if( ! in_array(Request::ipv4(), (array) $machinesIP) && In::requestURI() !== $uri )
        {
            Response::redirect($uri);
        }
    }

    /**
     * Do control machines ip
     * 
     * @param mixed $manipulation = NULL
     * 
     * @return boold
     */
    public static function isMachinesIP($manipulation = NULL)
    {
        $projects      = Config::get('Project');
        $restorationIP = $projects['restoration']['machinesIP'];

        if( PROJECT_MODE === 'restoration' || $manipulation !== NULL)
        {
            $ipv4 = Request::ipv4();

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

    /**
     * Restoration mode
     * 
     * @param mixed $settings = NULL
     * 
     * @return void
     */
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

        $currentPath          = $restorable === true ? strtolower(CURRENT_CFUNCTION) : strtolower(Request::getActiveURL());
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
                    Response::redirect($restorationRoutePage);
                }
            }

            foreach( $restorationPages as $k => $rp )
            {
                if( strstr($currentPath, strtolower($k)) )
                {
                    Response::redirect($rp);
                }
                else
                {
                    if( strstr($currentPath, strtolower($rp)) )
                    {
                        if( $currentPath !== $routePage )
                        {
                            Response::redirect($restorationRoutePage);
                        }
                    }
                }
            }
        }
    }
}

# Alias Restoration
class_alias('ZN\Restoration', 'Restoration');
