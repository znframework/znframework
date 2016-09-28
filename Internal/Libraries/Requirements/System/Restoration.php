<?php namespace ZN\Requirements\System;

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
    
    //--------------------------------------------------------------------------------------------------------
    // Is Machines IP
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function isMachinesIP()
    {
        $projects = \Config::get('Project');

        $restorationIP = $projects['restoration']['machinesIP'];
        
        if( PROJECT_MODE === 'restoration' )
        {
            $ipv4 = ipv4();
            
            if( is_array($restorationIP) )
            {
                $result = in_array($ipv4, $restorationIP);
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
    
        return (bool) $result;
    }

    //--------------------------------------------------------------------------------------------------------
    // Mode
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function mode()
    {
        if( self::isMachinesIP() === true ) 
        {
            return false;
        }
    
        error_reporting(0); 
            
        $projects           = \Config::get('Project');
        
        $restoration        = $projects['restoration'];
        $restorationPages   = $restoration['pages'];
        $routePage          = strtolower($restoration['routePage']);
        $currentPath        = strtolower(currentPath()); 
        
        if( is_string($restorationPages) )
        {
            if( $restorationPages === "all" )
            {
                if( $currentPath !== $routePage ) 
                {
                    redirect($restoration['routePage']);
                }
            }
        }
        
        if( is_array($restorationPages) && ! empty($restorationPages) )
        {       
            if( $restorationPages[0] === "all" )
            {
                if( $currentPath !== $routePage ) 
                {
                    redirect($restoration['routePage']);
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
                            redirect($restoration['routePage']);
                        }
                    }   
                }
            }
        }   
    }   
}

class_alias('ZN\Requirements\System\Restoration', 'Restoration');