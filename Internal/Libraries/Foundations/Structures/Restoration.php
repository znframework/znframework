<?php 
namespace ZN\Foundations\Structures;

class Restoration
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	public static function isMachinesIP()
	{
		$application   = \Config::get('Application');

		$restorationIP = $application['restoration']['machinesIP'];
		
		if( APPMODE === 'restoration' )
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

	public static function mode()
	{
		if( self::isMachinesIP() === true ) 
		{
			return false;
		}
	
		error_reporting(0); 
			
		$application        = \Config::get('Application');
		
		$restoration  		= $application['restoration'];
		$restorationPages   = $restoration['pages'];
		$routePage	  		= strtolower($restoration['routePage']);
		$currentPath  		= strtolower(currentPath()); 
		
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