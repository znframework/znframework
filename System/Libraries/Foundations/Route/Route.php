<?php
class __USE_STATIC_ACCESS__Route extends Controller implements RouteInterface
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
	// Route
	//----------------------------------------------------------------------------------------------------
	//
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	protected $route = array();
	
	//----------------------------------------------------------------------------------------------------
	// Change
	//----------------------------------------------------------------------------------------------------
	//
	// @param array $route
	//
	//----------------------------------------------------------------------------------------------------
	public function change($route = array())
	{
		if( is_array($route) )
		{
			$this->route = $route;
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Run
	//----------------------------------------------------------------------------------------------------
	// Genel Kullanım: Çalıştırılmak istenen kod bloklarını yönetmek için kullanılır.										  							  
	//  
	//  @param  string   $functionName
	//  @param  function $functionRun
	//  @return mixed
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function run($functionName = '', $functionRun = '', $route = array())
	{
		if( ! empty($this->route) )
		{
			$route = $this->route;
		}
		
		if( is_array($route) && ! empty($route) )
		{
			Config::set('Route', 'changeUri', $route);	
		}
		
		$datas = Structure::datas();
		
		$parameters = $datas['parameters'];
		$isFile     = $datas['isFile'];
		$function   = $datas['function'];
		
		if( APP_TYPE === 'local' )
		{
			set_error_handler('Exceptions::table');	
		}
		
		if( ( $functionName === 'construct' || $functionName === 'destruct' ) && is_callable($functionRun) )
		{
			call_user_func_array($functionRun, $parameters);
		}
		
		if( file_exists($isFile) )
		{
			if( strtolower($function) ===  'index' && strtolower($functionName) === 'main')
			{
				$function = 'main';	
			}
		
			if( $functionName === $function )
			{
				if( is_callable($functionRun) )
				{				
					call_user_func_array($functionRun, $parameters);	
				}
				else
				{
					// Sayfa bilgisine erişilemezse hata bildir.
					if( ! Config::get('Route', 'show404') )
					{				
						// Hatayı ekrana yazdır.
						echo Error::message('Error', 'callUserFuncArrayError', $functionRun);
						
						// Hatayı rapor et.
						report('Error', getMessage('Error', 'callUserFuncArrayError'), 'SystemCallUserFuncArrayError');
						
						// Çalışmayı durdur.
						return false;
					}
					else
					{
						redirect(Config::get('Route', 'show404'));
					}
				}
			}
		}
		
		if( APP_TYPE === 'local' )
		{
			restore_error_handler();
		}
	}	
}